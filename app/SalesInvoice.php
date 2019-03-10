<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesInvoice extends Model
{
    protected $table = 'sales_invoice';

    protected $fillable =  ['invoiceID','salesID','payment_due_date','invoice_amount','created_at','updated_at'];
    protected $primaryKey = 'invoiceID';
    public $incrementing = false; 
}
