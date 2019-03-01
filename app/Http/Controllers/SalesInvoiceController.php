<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalesInvoice;
use DB;
use Carbon\Carbon;
use App\SalesOrder;
use App\Product;
use App\Company;
use PDF;

class SalesInvoiceController extends Controller
{
    public function invoice(Request $request)
    {	
    	$invoiceID = "INV0000".DB::table('sales_invoice')->count();
    	$hasErrors = 0;
    	try {

    		SalesOrder::findOrFail($request->salesID)->update([
				'salesStatus' => 'Invoiced',
				'updated_at' => Carbon::now()
			]);

    		$salesinvoice = new SalesInvoice();
    		$salesinvoice->invoiceID = $invoiceID;
    	    $salesinvoice->salesID = $request->salesID;
    	    $salesinvoice->created_at = Carbon::now();
    	    $salesinvoice->updated_at = Carbon::now();
    	    $salesinvoice->save();
    	} catch (Exception $e) {
    		$hasErrors = 1;
    	}
    	return $hasErrors;
    }

    public function printInvoice($salesID)
    {
    	$salesorder = SalesOrder::where('salesID',$salesID)->first();
        $company = Company::first();
        $saleslines = DB::table('sales_line')->where('salesID','=', $salesID)->get();
        $products = Product::all();
        $validFrom = Carbon::now();
        $client = DB::table('client')->where('id','=',$salesorder->client_id)->first();
        $salesinvoice = DB::table('sales_invoice')->where('salesID','=',$salesID)->first();;

    	$pdf = PDF::loadView('salesorder.reports.salesinvoice', [
            'salesorder'=>$salesorder,
            'company' => $company,
            'saleslines' => $saleslines,
            'products' => $products,
            'validFrom' => $validFrom,
            'client' => $client,
            'salesinvoice' => $salesinvoice
        ])->setPaper('a4', 'landscape');;
	    // If you want to store the generated pdf to the server then you can use the store function
	    //$pdf->save(storage_path().'_filename.pdf');
	    // Finally, you can download the file using download function
	    return $pdf->download('Sales Invoice.pdf');
        //return view('salesorder.reports.report_layout')->with('company',$company);
    }
}
