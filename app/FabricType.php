<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FabricType extends Model
{
    protected $table = 'fabric_type';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
