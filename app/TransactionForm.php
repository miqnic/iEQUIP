<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionForm extends Model
{
    //Table Name
    protected $table ='transaction_forms';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = false;

    protected $fillable = [
        'returned', 'claimed', 'transaction_id', 'user_id', 'start_date', 'due_date', 'end_time', 'start_time', 'purpose', 'room_number' , 'approval', 'submitted_date', 'claimed_date', 'returned_date', 'approval_date', 'cancelled_date' 
    ];

    //Model Relationships
    public function equipment(){
        //an equipment belongs to a single user
        return $this->hasMany('App\Equipment', 'equipID', 'equip_name', 'returned');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'first_name', 'last_name', 'penalty');
    }
}
