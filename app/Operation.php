<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $table = 'operation';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
