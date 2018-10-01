<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FabricPrice extends Model
{
    protected $table = 'fabric_price';
    protected $primaryKey = 'fabric';
    public $timestamps = false;
}
