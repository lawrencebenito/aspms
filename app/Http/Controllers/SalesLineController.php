<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalesLine;
use DB;
use Carbon\Carbon;
use App\Product;

class SalesLineController extends Controller
{
    public function save(Request $request)
    {
    	$ctr = 0;
    	if($request->ajax())
    	{
    		$allProdID = $request->allProdID;
    		$allProductQty = $request->allQuantity;
    		$checkError = 0;

    		foreach ($allProdID as $productID) {
    			$product = DB::table('product')->where('id','=',$productID)->get();

    			try {
    				$salesline = new SalesLine();
    			    $salesline->salesID = $request->salesID;
    				$salesline->product_id = $productID;
    				$salesline->quantity = $allProductQty[$ctr];
    				$salesline->netAmount = $product[0]->total_price * $allProductQty[$ctr];
    				$salesline->created_at = Carbon::now();
    				$salesline->updated_at = Carbon::now();
    				$salesline->save();
    			} catch (Exception $e) {
    				$checkError = 1;
    			}
    			$ctr++;
    		}

    		return $checkError;
    	}
    }

    public function update(Request $request)
    { 
    	$allProdID = $request->allProdID;
    	$allProductQty = $request->allQuantity;
    	$allRecID = $request->allRecID;
    	$ctr = 0;
    	$checkError = 0;

    	foreach($allRecID as $recID)
    	{
    		try {
    			SalesLine::findOrFail($recID)->update([
    				'product_id' => $allProdID[$ctr],
    				'quantity' => $allProductQty[$ctr],
    				'salesID' => $request->salesID,
    				'updated_at' => Carbon::now()
    			]);

    		} catch (Exception $e) {
    			$checkError = 1;
    		}
    		$ctr++;
    	}
    	return $checkError;
    }
}
