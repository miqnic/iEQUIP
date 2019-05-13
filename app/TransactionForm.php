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
    public $timestamps = true;

    //Model Relationships
    public function equipment(){
        //an equipment belongs to a single user
        return $this->hasMany('App\Equipment', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'id');
    }
}
