<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalesOrder;
use App\SalesLine;
use App\SalesConfirmation;
use Carbon\Carbon;
use PDF;
use App\Company;
use App\Product;
use DB;
use App\Client;
use App\SalesInvoice;

class SalesConfirmationController extends Controller
{
    public function confirm(Request $request)
    {
    	$hasErrors = 0;
    	try {

    		SalesOrder::findOrFail($request->salesID)->update([
				'salesStatus' => 'Delivered',
				'updated_at' => Carbon::now()
			]);

    		$salesConfirmation = new SalesConfirmation();
    	    $salesConfirmation->salesID = $request->salesID;
    	    $salesConfirmation->created_at = Carbon::now();
    	    $salesConfirmation->updated_at = Carbon::now();
    	    $salesConfirmation->save();
    	} catch (Exception $e) {
    		$hasErrors = 1;
    	}
    	return $hasErrors;
    }
    public function printSOConfirmation($salesID)
    {
    	$salesorder = SalesOrder::where('salesID',$salesID)->first();
        $company = Company::first();
        $saleslines = DB::table('sales_line')->where('salesID','=', $salesID)->get();
        $products = Product::all();
        $validFrom = Carbon::now();
        $client = DB::table('client')->where('id','=',$salesorder->client_id)->first();
        
    	$pdf = PDF::loadView('salesorder.reports.deliveryreceipt', [
            'salesorder'=>$salesorder,
            'company' => $company,
            'saleslines' => $saleslines,
            'products' => $products,
            'validFrom' => $validFrom,
            'client' => $client
        ])->setPaper('a4', 'landscape');;
	    // If you want to store the generated pdf to the server then you can use the store function
	    //$pdf->save(storage_path().'_filename.pdf');
	    // Finally, you can download the file using download function
	    return $pdf->download('Delivery Receipt.pdf');
        //return view('salesorder.reports.report_layout')->with('company',$company);
    }
}
