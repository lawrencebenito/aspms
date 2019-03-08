<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentLines extends Model
{
    protected $table = 'payment_lines';

    protected $fillable =  ['recID','payment_no','order_id','created_at','updated_at'];
    // protected $primaryKey = 'recID';
    
}
