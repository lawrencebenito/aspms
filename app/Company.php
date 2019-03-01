<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';

    protected $fillable =  ['company_id','company_name','company_address','province','city','zipcode','contact_no','emailaddress','companyTIN','logo','created_at','updated_at'];
    protected $primaryKey = 'company_id';
    public $incrementing = false; 
}
