<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $table = 'quotation';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function getIdAttribute() {
        $fixed_chars = "QUO";
        $year = date("Y");

        return sprintf("%s%s%04d", $fixed_chars, $year, $this->attributes['id']);
    }
}
