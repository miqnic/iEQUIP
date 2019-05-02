<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionForm extends Model
{
    //Table Name
    protected $table ='transaction_forms';
    //Primary Key
    public $primaryKey = 'transaction_id';
    //Timestamps
    public $timestamps = true;

    //Model Relationships
    public function Equipment(){
        //an equipment belongs to a single user
        return $this->hasMany('App\Equipment', 'due_date', 'user_id');
    }
}
