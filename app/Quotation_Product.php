<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation_Product extends Model
{
    protected $table = 'quotation_product';
    protected $primaryKey = 'id';
    public $timestamps = false; 
}
