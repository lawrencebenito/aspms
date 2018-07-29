<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Garment extends Model
{
    protected $table = 'garment';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
