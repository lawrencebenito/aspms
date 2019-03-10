<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Company;
use Carbon\Carbon;
use DB;
use App\TransLog;

class CustomerTransLogController extends Controller
{
    public function index($clientID)
    {
    	$company = Company::first();
    	$now = Carbon::now();
    	$client = DB::table('client')->where('id','=',$clientID)->first();
    	$transLog = DB::table('trans_log')->where('clientID','=',$clientID)->get();

    	return view('salesorder.cust_trans_log')->with('company',$company)
    											->with('client',$client)
    											->with('now',$now)
    											->with('transLog',$transLog);

    }
}
