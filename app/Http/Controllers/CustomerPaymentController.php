<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerPaymentController extends Controller
{
    public function index(Request $request)
    {
    	return view('salesorder.customer_payment_index');
    }
}
