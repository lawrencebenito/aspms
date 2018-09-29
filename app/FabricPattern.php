<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FabricPattern extends Model
{
    protected $table = 'fabric_pattern';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
