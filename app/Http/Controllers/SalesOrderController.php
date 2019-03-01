<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalesOrder;
use App\Client;
use DB;
use Carbon\Carbon;
use App\Product;
use App\SalesLine;

class SalesOrderController extends Controller
{
    public function index()
    {
        $sales_orders = SalesOrder::latest('created_at')->paginate(10);
        $clients = Client::all();
        
        return view('salesorder.salesorder')->with('sales_orders',$sales_orders)
        									->with('clients',$clients);
        									
    }

    public function new(Request $request)
    {
    	if($request->ajax()){
    		$salesID = "S0000".DB::table('sales_table')->count();
    	}
    	$clients = Client::all();
    	
    	return view('salesorder.modals.create_modal')->with('clients',$clients)
    											     ->with('salesid',$salesID);
    }

    public function create(Request $request)
    {
    	if($request->ajax()){
    		$salesID = $request->salesID;
    		$custaccount = $request->custaccount;
    		$client = DB::table('client')->where('id','=',$custaccount)->get();
    		SalesOrder::create(['salesID'=>$salesID,'client_id'=>$custaccount,'salesStatus'=>'Open Order','releaseStatus'=>'Open','requestedDeliveryDate'=>$request->deliveryDate,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);
    	}
    	$sales_orders = SalesOrder::latest('created_at')->paginate(10);
    	return view('salesorder.partial_table')->with('sales_orders',$sales_orders)
    											->with('company_name',$client[0]->company_name);
    }

    public function salesline(Request $request)
    {
    	$sales_order = DB::table('sales_table')->where('salesID','=',$request->salesID)->get();
		$client = DB::table('client')
					->where('id','=',$sales_order[0]->client_id)
					->get();
    	if($request->ajax())
    	{
    		if($request->reqData == "create")
    		{ 
	    		return view('salesorder.modals.salesline_modal')
	    				->with('sales_order',$sales_order[0])
	    				->with('client',$client[0]);
    		}
    		else if($request->reqData=="view")
    		{
    			$hasRecord = 0;
    			$saleslines = DB::table('sales_line')->where('salesID','=',$request->salesID)->get();
    			foreach ($saleslines as $key => $value) {
    				$hasRecord = 1;
    			}
    			if($hasRecord == 0)
    			{
		    		return view('salesorder.modals.salesline_modal')
		    				->with('sales_order',$sales_order[0])
		    				->with('client',$client[0]);
    			}
    			else if($hasRecord == 1)
    			{
    				$products = DB::table('product')->get();
    				return view('salesorder.modals.salesline_modal_view')
		    				->with('sales_order',$sales_order[0])
		    				->with('client',$client[0])
		    				->with('saleslines',$saleslines)
		    				->with('products',$products);
    			}
    		}	
    	}
    }

    public function addRow(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->reqData == "getProductDetails")
    		{
    			$product = DB::table('product')
    							->where('id','=',$request->productID)
    			                ->get();
    			 return $product;
    		}
    		else if($request->reqData == "addRow")
    		{
    			$defaultVal = "---";
    			if($request->prodID)
    			{
    				$defaultVal = $request->prodID;
    			}
    			$products = DB::table('product')->get();
		    	$options = '<select class="form-control productID" onchange="getProductDetails(this.value,'.$request->ctr.')" required>
				        <option value="" disabled selected>'.$defaultVal.'</option>';
		    	foreach ($products as $key => $value) {
		    		$options = $options.'<option  id="itemNo" value="'.$value->id.'">'.
		            $value->id.
		          '</option>';
		        }

			    $options =$options.'</select>';
		    	
		    	return $options;
    		}
    	}
    }
}
