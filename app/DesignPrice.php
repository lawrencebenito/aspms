<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignPrice extends Model
{
    protected $table = 'design_price';
    protected $primaryKey = 'design';
    public $timestamps = false;
}
