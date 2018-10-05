<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GarmentFabric extends Model
{
    protected $table = 'garment_fabric';
    protected $primaryKey = 'garment';
    public $timestamps = false;
}
