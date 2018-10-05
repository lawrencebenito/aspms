<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessoryType extends Model
{
    protected $table = 'accessory_type';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
