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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'equipID', 'equip_name', 'equip_description', 'equip_penalty', 'equip_baseprice', 'equip_img', 'equip_avail', 'returned', 'equip_category'
    ];

    //Model Relationships
    public function TransactionForm(){
        //an equipment belongs to a single user
        return $this->hasOne('App\TransactionForm', 'due_date', 'user_id');
    }
}
