<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Accessory extends Model
{
    protected $table = 'product_accessory';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
