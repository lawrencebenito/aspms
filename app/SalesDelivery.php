<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesDelivery extends Model
{
    protected $table = 'sales_delivery';

    protected $fillable =  ['deliveryID','salesID','delivery_mode','delivery_address','created_at','updated_at'];
    protected $primaryKey = 'deliveryID';
    public $incrementing = false; 
}
