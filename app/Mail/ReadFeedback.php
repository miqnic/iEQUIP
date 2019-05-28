<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Feedback;
use Carbon\Carbon;

class ReadFeedback extends Mailable
{

    use Queueable, SerializesModels;
    public $feedbackSubject;
    public $feedbackBody;

    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Feedback $feedback)
    {
        $this->feedbackSubject = $feedback->subject;
        $this->feedbackBody = $feedback->body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('iEQUIP: Feedback Has Been Read')
                    ->view('emailFeedbackRead')->with([
            'feedbackSubject' => $this->feedbackSubject,
            'feedbackBody' => $this->feedbackBody
        ]);
    }
}
