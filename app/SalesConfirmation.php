<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesConfirmation extends Model
{
    protected $table = 'sales_confirmation';

    protected $fillable =  ['recID','salesID','created_at','updated_at'];
    protected $primaryKey = 'recID';
    public $incrementing = false; 
}
