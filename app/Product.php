<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function getStyleNumberAttribute() {
        $fixed_chars = "PROD";
        $year = date("Y");

        return sprintf("%s%s%04d",$fixed_chars, $year, $this->attributes['id']);
    }
}
