<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GarmentOperation extends Model
{
    protected $table = 'garment_operation';
    protected $primaryKey = 'garment';
    public $timestamps = false;
}
