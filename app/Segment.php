<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    protected $table = 'segment';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
