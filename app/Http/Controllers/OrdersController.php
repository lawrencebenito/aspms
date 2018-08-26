<?php

namespace App\Http\Controllers;

use App\Order;
use App\Quotation;
use App\Product;

use App\Includes\StaticCounter;
use App\Includes\SmartMove;


use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $client = Client::select(
        //     'id','company_name','last_name','first_name','contact_num','email_address')
        //     ->get();
        $client = [];
        return view('orders.index')->with('client', $client);
    }

    /**
     * Redirects to other contoller
     *
     * @return \Illuminate\Http\Response
     */
    public function quotation()
    {
        $new_order = true;
        return redirect('quotations')->with('new_order', $new_order);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $quotation = json_decode($request->get('quotation'));
        $products = json_decode($request->get('products'));
        
        //get the array of selected products from the checkbox
        $choosen_products = $request->get('choosen_products'); 
        
        $selected_products = array();
        
        foreach ($choosen_products as $index) {
            array_push( $selected_products, $products[$index]);
        }
        
        return view('orders.create')->with('quotation', $quotation)->with('products',$selected_products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
