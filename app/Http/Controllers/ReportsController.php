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
use App\Order;
//use Charts;

class ReportsController extends Controller
{
    public function sales_report()
    {
    	//$salesorder = SalesOrder::latest('created_at')->paginate(10);

        // $chart = Charts::database($SalesOrder, 'pie', 'highcharts')
        //           ->title("Sales Report")
        //           ->elementLabel("Total Sales")
        //           ->dimensions(1000, 500)
        //           ->responsive(false)
        //           ->groupByMonth(date('Y'), true);

    	return view('salesorder.sales_report_index');
    }

    public function print_sales_report(Request $request)
    {
        $sales_orders = Order::latest('date_created')->get();
        $clients = Client::all();
        $products = Product::all();
        $order_lines = DB::table('order_product')->get();
        $now = Carbon::now();
        $company = Company::first();

        return view('salesorder.reports.sales_report')->with('company',$company)
                                                      ->with('fromDate',$request->startFrom)
                                                      ->with('toDate',$request->endTo)
                                                      ->with('now',$now)
                                                      ->with('sales_orders',$sales_orders)
                                                      ->with('order_lines',$order_lines)
                                                      ->with('products',$products)
                                                      ->with('clients',$clients);
    }

    public function export_sales_report(Request $request)
    {
        $sales_orders = Order::latest('date_created')->get();
        $clients = Client::all();
        $products = Product::all();
        $order_lines = DB::table('order_product')->get();
        $now = Carbon::now();
        $company = Company::first();

        $pdf = PDF::loadView('salesorder.reports.sales_report_report',[
            'company'=>$company,
            'fromDate' => $request->startFrom,
            'toDate' => $request->endTo,
            'now' => $now,
            'sales_orders' => $sales_orders,
            'order_lines' => $order_lines,
            'products' => $products,
            'clients' => $clients
        ]);

        return $pdf->download('Sales Quatation.pdf');
    }

    public function printQuotation($quotationID)
    {
        $quotation = DB::table('quotation')->where('id','=',$quotationID)->first();
        $company = Company::first();
        $client = DB::table('client')->where('id','=',$quotation->client)->first();
        $quotation_lines = DB::table('quotation_product')->where('quotation','=',$quotationID)->get();
        $products = Product::all();
        return view('salesorder.reports.quotation',[
            'quotation'=>$quotation,
            'client' => $client,
            'quotationlines' => $quotation_lines,
            'products' => $products,
            'company' => $company
        ]);
    }
    public function quotation_exportPDF($quotationID)
    {
        $quotation = DB::table('quotation')->where('id','=',$quotationID)->first();
        $company = Company::first();
        $client = DB::table('client')->where('id','=',$quotation->client)->first();
        $quotation_lines = DB::table('quotation_product')->where('quotation','=',$quotationID)->get();
        $products = Product::all();

        $pdf = PDF::loadView('salesorder.reports.quotation_report',[
            'quotation'=>$quotation,
            'client' => $client,
            'quotationlines' => $quotation_lines,
            'products' => $products,
            'company' => $company
        ]);
        
        return $pdf->download('Sales Quatation.pdf');
    }
}
