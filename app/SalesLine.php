<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesLine extends Model
{
    protected $table = 'sales_line';

    protected $fillable =  ['recID','salesID','product_id','quantity','netAmount','created_at','updated_at'];
    protected $primaryKey = 'recID';
    public $incrementing = false; 
}
