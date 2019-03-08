<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable =  ['id','date_ordered','client','po_number','payment_terms','remarks','status','salesStatus','date_created','date_modified'];
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function getIdAttribute() {

        return sprintf("%04d", $this->attributes['id']);
    }
}
