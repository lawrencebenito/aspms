<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $table = 'quotation';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function getIdAttribute() {
        return sprintf("%04d", $this->attributes['id']);
    }
}
