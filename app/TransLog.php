<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransLog extends Model
{
    protected $table = 'trans_log';

    protected $fillable =  ['recID','transID','clientID','description','amount','payment','remaining','created_at','updated_at'];
    protected $primaryKey = 'recID';
    public $incrementing = false; 
}
