<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    protected $table = 'cust_payment';

    protected $fillable =  ['payment_no','client_id','payment_mode','payment_type','payment_amount','payment_status','created_at','updated_at'];
    protected $primaryKey = 'payment_no';
    public $incrementing = false; 
}
