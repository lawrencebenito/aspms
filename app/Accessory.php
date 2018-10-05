<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    protected $table = 'accessory';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
