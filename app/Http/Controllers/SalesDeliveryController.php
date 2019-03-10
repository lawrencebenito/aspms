<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalesDelivery;
use DB;
use Carbon\Carbon;
use App\Order;
use App\Company;
use App\Product;
use PDF;

class SalesDeliveryController extends Controller
{
    public function new(Request $request)
    {
    	$deliveryID = "DELV000".DB::table('sales_delivery')->count();
    	return view('salesorder.modals.delivery.deliver_modal')->with('deliveryID',$deliveryID);
    }

    public function save(Request $request)
    {
    	$hasErrors = 0 ;

    	if($request->ajax())
    	{
    		Order::findOrFail($request->salesID)->update([
				'salesStatus' => 'Delivered',
				'date_modified' => Carbon::now()
			]);

    		try {
    			$delivery = new SalesDelivery();
    			$delivery->deliveryID = $request->deliveryID;
    			$delivery->salesID = $request->salesID;
    			$delivery->delivery_mode = $request->delivery_mode;
    			$delivery->delivery_address = $request->delivery_address;
    			$delivery->created_at = Carbon::now();
    			$delivery->updated_at = Carbon::now();
    			$delivery->save();

    		} catch (Exception $e) {
    			$hasErrors = 1;
    		}
    	}
    }

    public function print_delivery_receipt($salesID)
    {
        $company = Company::first();
        $now = Carbon::now();
        $delivery = SalesDelivery::where('salesID',$salesID)->first();
        $salesorder = Order::where('id',$salesID)->first();
        $products = Product::all();
        $orderlines = DB::table('order_product')->where('order','=',$salesorder->id)->get();
        $client = DB::table('client')->where('id','=',$salesorder->client)->first();
        return view('salesorder.reports.deliveryreceipt')->with('company',$company)
                                                        ->with('now',$now)
                                                        ->with('salesID',$salesID)
                                                        ->with('products',$products)
                                                        ->with('orderlines', $orderlines)
                                                        ->with('delivery',$delivery)
                                                        ->with('client',$client);
    }

    public function export_delivery_receipt($salesID)
    {
        $company = Company::first();
        $now = Carbon::now();
        $salesorder = Order::where('id',$salesID)->first();
        $products = Product::all();
        $orderlines = DB::table('order_product')->where('order','=',$salesorder->id)->get();
        $client = DB::table('client')->where('id','=',$salesorder->client)->first();
        $delivery = SalesDelivery::where('salesID',$salesID)->first();
        $pdf = PDF::loadView('salesorder.reports.deliveryreceipt_report', [
            'salesorder'=>$salesorder,
            'company' => $company,
            'saleslines' => $orderlines,
            'products' => $products,
            'validFrom' => $now,
            'client' => $client,
            'delivery' => $delivery
        ])->setPaper('a4', 'landscape');
        return $pdf->download('Delivery Receipt.pdf');
    }
}
