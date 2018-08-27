<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Product extends Model
{
    protected $table = 'order_product';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
