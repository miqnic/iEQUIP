<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailAll extends Mailable
{

    use Queueable, SerializesModels;
    public $penalty;
    public $first_name;
    public $last_name;
    public $user_id;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->penalty = $request->penalty;
        $this->first_name = $request->first;
        $this->last_name = $request->last;
        $this->user_id = $request->id;   
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('iEQUIP: Penalty Fee Reminder')
                    ->view('emailAll')->with([
            'penalty' => $this->penalty,
            'first' => $this->first_name,
            'last' => $this->last_name,
            'id' => $this->user_id
        ]);
    }
}
