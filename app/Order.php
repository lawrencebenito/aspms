<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function getIdAttribute() {
        $fixed_chars = "ORD";
        $year = date("Y");

        return sprintf("%s%s%04d", $fixed_chars, $year, $this->attributes['id']);
    }
}
