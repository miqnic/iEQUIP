<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{

    //Table Name
    protected $table ='feedbacks';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    protected $fillable = [
        'user_id', 'subject', 'feedback_type', 'body'
    ];
    
    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'first_name', 'last_name');
    }
}
