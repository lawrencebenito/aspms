<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Design extends Model
{
    protected $table = 'product_design';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
