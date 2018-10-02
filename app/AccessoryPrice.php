<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessoryPrice extends Model
{
    protected $table = 'accessory_price';
    protected $primaryKey = 'fabric';
    public $timestamps = false;
}
