<?php

namespace App\Http\Controllers;

use App\Mail\StudentFeedback;
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
        //make dummy email to
        Mail::to('admin-ca3ec7@inbox.mailtrap.io')->send(new StudentFeedback($request));
        //return view('/student/contact);
        return redirect('/student/contact')->with('status', 'Feedback is sent!');
    }
}
