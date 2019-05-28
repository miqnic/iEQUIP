<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;
    //Table Name
   protected $table ='carts';
   //Primary Key
   public $primaryKey = 'id';
   //Timestamps
   public $timestamps = false;

   protected $dates = ['deleted_at'];

   protected $fillable = [
       'user_id', 'transaction_id', 'equipID', 'equip_name'
   ];
   
   public function user(){
       return $this->hasMany('App\User', 'user_id');
   }

    public function equipment(){ 
        return $this->hasMany('App\Equipment', 'equipID', 'equip_name');
    }

    public function TransactionForm(){
        //an equipment belongs to a single user
        return $this->hasMany('App\TransactionForm', 'due_date', 'user_id', 'transaction_id');
    }
}
