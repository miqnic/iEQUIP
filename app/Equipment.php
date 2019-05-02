<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    //Table Name
    protected $table ='equipment';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    //Model Relationships
    public function TransactionForm(){
        //an equipment belongs to a single user
        return $this->hasOne('App\TransactionForm', 'due_date', 'user_id');
    }
}
