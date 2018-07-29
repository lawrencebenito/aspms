<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $table = 'employee';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
