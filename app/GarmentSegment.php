<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GarmentSegment extends Model
{
    protected $table = 'garment_segment';
    protected $primaryKey = 'garment';
    public $timestamps = false;
}
