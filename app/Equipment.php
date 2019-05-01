<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    //Table Name
    protected $table ='equipment';
    //Primary Key
    public $primaryKey = 'equipID';
    //Timestamps
    public $timestamps = true;

    /*//Model Relationships
    public function user(){
        //an equipment belongs to a single user
        return $this->belongsTo('App\User');
    }*/
}
