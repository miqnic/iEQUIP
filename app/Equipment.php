<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use SoftDeletes;

    //Table Name
    protected $table ='equipment';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'equip_name', 'equip_description', 'equip_penalty', 'equip_baseprice', 'equip_img', 'equip_avail', 'returned', 'equip_category', 'transaction_id'
    ];

    //Model Relationships
    public function TransactionForm(){
        //an equipment belongs to a single user
        return $this->hasOne('App\TransactionForm', 'due_date', 'user_id', 'transaction_id');
    }
}
