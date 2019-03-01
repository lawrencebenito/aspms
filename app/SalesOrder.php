<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $table = 'sales_table';

    protected $fillable =  ['salesID','client_id','salesStatus','releaseStatus','requestedDeliveryDate','created_at','updated_at'];
    protected $primaryKey = 'salesID';
    public $incrementing = false; 
}
