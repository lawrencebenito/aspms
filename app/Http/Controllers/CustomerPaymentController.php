<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerPayment;
use DB;
use App\Client;
use Carbon\Carbon;
use App\Product;
use App\SalesDelivery;
use App\Order;
use App\PaymentLines;
use App\Company;
use App\Order_Product;
use Illuminate\Support\Facades\Input;
use PDF;

class CustomerPaymentController extends Controller
{
    public function index(Request $request)
    {
    	$cust_payments = CustomerPayment::latest('created_at')->paginate(10);
    	$clients = Client::all();
    	return view('salesorder.customer_payment_index')
    			->with('cust_payments',$cust_payments)
    			->with('clients',$clients);
    }
    public function create(Request $request)
    {
    	$paymentID = "CUSTPAYM000".DB::table('cust_payment')->count();
    	$clients = Client::all();
    	return view('salesorder.modals.payment.payment_create_modal')
    			->with('paymentID',$paymentID)
    			->with('clients',$clients);
    }

    public function save(Request $request)
    {
    	$hasErrors = 0;
    	if($request->ajax())
    	{
    		try {
    			$cust_payment = new CustomerPayment();
    			$cust_payment->payment_no = $request->payment_no;
    			$cust_payment->client_id = $request->client_id;
    			$cust_payment->payment_mode = $request->payment_mode;
    			$cust_payment->payment_type = $request->payment_type;
    			$cust_payment->payment_status = 'Settled';
    			$cust_payment->payment_amount = $request->payment_amount;
    			$cust_payment->created_at = Carbon::now();
    			$cust_payment->updated_at = Carbon::now();
    			
    			$cust_payment->save();

    			$allSalesID = Input::get('allSalesID');
    			foreach ($allSalesID as $salesID) {
    				Order::findOrFail($salesID)->update([
    				'salesStatus' => 'Paid',
    				'date_modified' => Carbon::now()
    		    	]);

    		    	$payment_lines = new PaymentLines();
    		    	$payment_lines->payment_no = $request->payment_no;
    		    	$payment_lines->order_id = $salesID;
    		    	$payment_lines->created_at = Carbon::now();
    		    	$payment_lines->updated_at = Carbon::now();
                    $payment_lines->save();
    			}

    		} catch (Exception $e) {
    			$hasErrors = 1;
    		}
    	}
    	$cust_payments2 = CustomerPayment::latest('created_at')->paginate(10);
    	$clients = Client::all();
    	return view('salesorder.partials.partial_payment_table')
    			->with('cust_payments',$cust_payments2)
    			->with('clients',$clients);
    }

    public function view(Request $request)
    {
    	$payment = DB::table('cust_payment')->where('payment_no','=',$request->payment_no)->first();
       // $payment_lines = DB::table('payment_lines')->where('payment_no','=',$request->payment_no)->get();
    	$client = Client::all();
    	$orders = Order::all();
    	$orderlines = Order_Product::all();
    	$deliveries = SalesDelivery::all();
        $products = Product::all();

        $payment_lines = DB::table('payment_lines')->where('payment_no','=',$request->payment_no)
                        ->join('sales_delivery','sales_delivery.salesID','=','payment_lines.order_id')
                        ->select('payment_lines.order_id','payment_lines.payment_no','payment_lines.created_at',
                                 'sales_delivery.created_at as delivery_date','sales_delivery.deliveryID')
                        ->get();
        
    	return view('salesorder.modals.payment.payment_details_modal')
    			->with('payment',$payment)
    			->with('orders',$orders)
    			->with('deliveries',$deliveries)
    			->with('orderlines',$orderlines)
    			->with('products',$products)
    			->with('payment_lines',$payment_lines);
    }

    public function settle_payment(Request $request)
    {
    	$hasErrors = 0;
    	if($request->ajax())
    	{
    		try 
    		{
    			CustomerPayment::findOrFail($request->payment_no)->update([
    				'payment_status' => 'Settled',
    				'updated_at' => Carbon::now()
    		    ]);

    			$allSalesID = Input::get('allSalesID');
    			foreach ($allSalesID as $salesID) {

    		    	$payment_lines = new PaymentLines();
    		    	$payment_lines->payment_no = $request->payment_no;
    		    	$payment_lines->order_id = $salesID;
    		    	$payment_lines->created_at = Carbon::now();
    		    	$payment_lines->updated_at = Carbon::now();
                    $payment_lines->save();

                    // PaymentLines::create(['payment_no'=>$request->payment_no,'order_id'=>$salesID,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);

                    Order::findOrFail($salesID)->update([
                    'salesStatus' => 'Paid',
                    'date_modified' => Carbon::now()
                    ]);
    			}
    		} catch (Exception $e) {
    			$hasErrors = 1;
    		}

    		return $hasErrors;
    	}
    }

    public function get_client_orders(Request $request)
    {
    	if($request->ajax())
    	{
    		$client = DB::table('client')->where('id','=',$request->clientid)->first();
	    	$orders = DB::table('order')->where('client','=', $client->id)->where('salesStatus','=','Invoiced')->get();
	    	$orderlines = DB::table('order_product')->get();
	    	$deliveries = SalesDelivery::all();
	        $products = Product::all();

	        return view('salesorder.partials.partial_payment_table_clientorders')
    			->with('orders',$orders)
    			->with('deliveries',$deliveries)
    			->with('orderlines',$orderlines)
    			->with('products',$products);
    	}
    }

    public function print_OR($payment_no)
    {
    	$company = Company::first();
        $cust_payment = DB::table('cust_payment')->where('payment_no','=',$payment_no)->first();
    	$now = Carbon::now();
    	return view('salesorder.reports.official_receipt')
    				->with('company',$company)
    				->with('now',$now)
    				->with('payment_no',$payment_no)
                    ->with('cust_payment',$cust_payment);
    }
     public function export_OR($payment_no)
    {
    	$company = Company::first();
    	$now = Carbon::now();

    	$pdf = PDF::loadView('salesorder.reports.official_receipt_report',[
            'now'=>$now,
            'company' => $company,
            'payment_no' => $payment_no
        ])->setPaper('a4', 'landscape');
        
        return $pdf->download('Official Receipt.pdf');
    }

    public function delete(Request $request)
    {
        //return $request->payment_no;
       $hasErrors = 0;
       try {
            CustomerPayment::findOrFail($request->payment_no)->delete();
       } catch (Exception $e) {
           $hasErrors = 1;
       }

        $cust_payments2 = CustomerPayment::latest('created_at')->paginate(10);
        $clients = Client::all();
        return view('salesorder.partials.partial_payment_table')
                ->with('cust_payments',$cust_payments2)
                ->with('clients',$clients);
    }
}
