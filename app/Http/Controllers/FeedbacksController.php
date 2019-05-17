<?php

namespace App\Http\Controllers;

use App\Mail\StudentFeedback;
use App\Mail\EmailAll;
use App\Feedback;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class FeedbacksController extends Controller
{
    /**
     * Ship the given order.
     *
     * @param  Request  $request
     * @param  int  $orderId
     * @return Response
     */

    public function feedback(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'feedbackType' => 'required',
            'body' => 'required'
        ]);

        //make dummy email to  admin-ca3ec7@inbox.mailtrap.io
        Mail::to('ac01f813b2-8ea59b@inbox.mailtrap.io')->send(new StudentFeedback($request));
        
        //return view('/student/contact);

        $feedback = new Feedback([
            'user_id' =>  auth()->user()->user_id,
            'subject' => $request->get('subject'),
            'feedback_type' => $request->get('feedbackType'),
            'body' => $request->get('body')
          ]);
        
        $feedback->save();


        return redirect('/student/contact')->with('success', 'Feedback is sent!');
    }

    public function emailAll(Request $request){
        $users = User::where('penalty', '>', '0')
                        ->get();
        //dd($users);
        

        foreach ($users as $user) {
            $request->request->add(['penalty' => $user->penalty, 'id' => $user->user_id, 'first' => $user->first_name, 'last' => $user->last_name]);
            Mail::to('ac01f813b2-8ea59b@inbox.mailtrap.io')->send(new EmailAll($request));
        }

        return redirect('/admin/balances')->with('success', 'Emails are sent!');
    }

    public function adminFeedbacks(){
        $newest = Feedback::orderBy('created_at', 'desc')
                            ->get();
        $oldest =  Feedback::orderBy('created_at', 'asc')
                            ->get();
        $types = Feedback::orderBy('feedback_type', 'asc')
                            ->get();
        $filterUnread = Feedback::where('read', false)
                                ->get();     
        $filterRead = Feedback::where('read', true)
                                ->get();  
        $filterAll = Feedback::get();  
        $users = User::get();
        return view('admin.feedbacks')->with('newest', $newest)
                                      ->with('oldest', $oldest)
                                      ->with('types',$types)
                                      ->with('users',$users)
                                      ->with('filterUnread',$filterUnread)
                                      ->with('filterRead',$filterRead)
                                      ->with('filterAll',$filterAll);
    }

    public function read(Request $request){
        $feedback = Feedback::find($request->get('feedbackid'));
        $feedback->read = true;

        $feedback->save();

        return redirect()->back();
    }
}