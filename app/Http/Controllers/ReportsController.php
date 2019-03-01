<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalesOrder;
use App\Product;
use App\Client;
use App\SalesLine;
use Carbon\Carbon;
use App\Company;
use PDF;
use DB;
//use Charts;

class ReportsController extends Controller
{
    public function sales_report()
    {
    	$salesorder = SalesOrder::latest('created_at')->paginate(10);

        // $chart = Charts::database($SalesOrder, 'pie', 'highcharts')
        //           ->title("Sales Report")
        //           ->elementLabel("Total Sales")
        //           ->dimensions(1000, 500)
        //           ->responsive(false)
        //           ->groupByMonth(date('Y'), true);

    	return view('salesorder.sales_report_index')->with('sales_orders',$salesorder);
    }

    public function print_sales_report(Request $request)
    {
    	$salesorder = DB::table('sales_table')->where('sales_table.salesStatus','=','Invoiced')
                                            ->whereBetween('sales_table.created_at', [$request->startFrom, $request->endTo])
                                            ->get();
        $company = Company::first();
        $saleslines = SalesLine::all();
        $products = Product::all();
        $validFrom = Carbon::now();
        $client = Client::all();
        $fromDate = $request->startFrom;
        $toDate = $request->endTo;
        
    	$pdf = PDF::loadView('salesorder.reports.sales_report', [
            'salesorders'=>$salesorder,
            'company' => $company,
            'saleslines' => $saleslines,
            'products' => $products,
            'validFrom' => $validFrom,
            'clients' => $client,
            'fromDate' => $fromDate,
            'toDate' => $toDate
        ])->setPaper('a4', 'landscape');;
	    // If you want to store the generated pdf to the server then you can use the store function
	    //$pdf->save(storage_path().'_filename.pdf');
	    // Finally, you can download the file using download function
	    return $pdf->download('Sales Report.pdf');
    }
}
