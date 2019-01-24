<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Operation extends Model
{
    protected $table = 'product_operation';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
