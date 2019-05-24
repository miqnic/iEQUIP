<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Equipment;
use Carbon\Carbon;

class Received extends Mailable
{

    use Queueable, SerializesModels;
    public $penalty;
    public $first_name;
    public $last_name;
    public $user_id;
    public $course;
    public $sub_date;
    public $end_date;
    public $end_time;
    public $room;
    public $reason;
    public $form_id;

    public $equipments;
    public $unique;

    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->first_name = $request->first;
        $this->last_name = $request->last;
        $this->user_id = $request->user_id;   
        $this->course = $request->course;   
        $this->sub_date = $request->sub_date;  
        $this->start_date = $request->start_date;   
        $this->start_time = $request->start_time;   
        $this->end_date = $request->end_date;   
        $this->end_time = $request->end_time;   
        $this->room = $request->room;
        $this->reason = $request->reason;   
        $this->form_id = $request->currentForm;   

        $this->equipments = Equipment::where('transaction_id', $this->form_id)->get();
        //dd($this->equipments);
        //$this->unique = Equipment::where('transaction_id', $this->form_id)->get()->unique();
        //dd($this->equipments);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('iEQUIP: Transaction Form Received')
                    ->view('emailReceived')->with([
            'penalty' => $this->penalty,
            'first' => $this->first_name,
            'last' => $this->last_name,
            'id' => $this->user_id,
            'course' => $this->course,
            'sub_date' => $this->sub_date,
            'start_date' => $this->start_date,
            'start_time' => $this->start_time,
            'end_date' => $this->end_date,
            'end_time' => $this->end_time,
            'room' => $this->room,
            'reason' => $this->reason,
            'form_id' => $this->form_id,
            //'unique' => $this->unique,
            'equipments' => $this->equipments
        ]);
    }
}
