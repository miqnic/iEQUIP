<?php

namespace App\Http\Controllers;

use App\Mail\StudentFeedback;
use App\Feedback;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class EmailsController extends Controller
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

        //make dummy email to ac01f813b2-8ea59b@inbox.mailtrap.io
        Mail::to('admin-ca3ec7@inbox.mailtrap.io')->send(new StudentFeedback($request));
        
        //return view('/student/contact);

        $feedback = new Feedback([
            'user_id' =>  auth()->user()->user_id,
            'subject' => $request->get('subject'),
            'feedback_type' => $request->get('feedbackType'),
            'body' => $request->get('body')
          ]);
        
        $feedback->save();


        return redirect('/student/contact')->with('status', 'Feedback is sent!');
    }

    public function adminFeedbacks(){
        $newest = Feedback::where('read',false)
                            ->orderBy('created_at', 'desc')
                            ->get();
        $oldest =  Feedback::where('read',false)
                            ->orderBy('created_at', 'asc')
                            ->get();
        $types = Feedback::where('read',false)
                        ->orderBy('feedback_type', 'asc')
                        ->get();
        $users = User::get();
        return view('admin.feedbacks')->with('newest', $newest)
                                      ->with('oldest', $oldest)
                                      ->with('types',$types)
                                      ->with('users',$users);
    }

/*     public function read($id){
        $feedback = Feedback::find($id)->first();
        $feedback->read = true;

        $feedback->save();

        return view('admin.feedbacks');
    } */
}