<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    //Table Name
    protected $table ='transaction_forms';
    //Primary Key
    public $primaryKey = 'transaction_id';
    //Timestamps
    public $timestamps = true;

    /*//Model Relationships
    public function user(){
        //an equipment belongs to a single user
        return $this->belongsTo('App\User');
    }*/
}
