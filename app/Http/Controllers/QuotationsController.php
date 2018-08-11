<?php

namespace App\Http\Controllers;

use DB;
use App\Quotation;
use App\Product;
use Illuminate\Http\Request;

class QuotationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotations = Quotation::join('client','client.id', '=','quotation.client')
            ->select('quotation.id','client.last_name','client.first_name','client.company_name','quotation.date_created', 'quotation.product_count')
            ->get();
        return view('quotations.index')->with('quotations', $quotations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quotations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $quotation = new Quotation;
            $quotation->client = $request->get('client');
            $quotation->date_created = $request->get('date_created');
            $quotation->product_count = count($request->get('garment'));
            
            $temp_array = array();
        
            $products = DB::transaction(function()  use ($request, $quotation, $temp_array) {
                
                $quotation->save();
                $quotation_id = $quotation->id;

                $garment_index = 0;
                for ($fabric_index = 0, $fcount_index = 0; 
                    $fabric_index < count($request->get('fabric'));
                    $fabric_index++, $fcount_index++) { 
                    
                    $product = new Product;
                    $product->quotation = $quotation_id;
                    $product->garment = $request->get('garment')[$garment_index];
                    $product->fabric = $request->get('fabric')[$fabric_index];
                    $product->unit_price = $request->get('unit_price')[$fabric_index];
                    $product->description = $request->get('description')[$garment_index];
                    
                    $fcount = $request->get('fabric_count')[$garment_index];
                    //array_push($temp_array, [$product, $fcount_index, $fcount]);
                    $product->save();
                    

                    if($fcount_index == ((int)$fcount)- 1){
                        $garment_index++;
                        $fcount_index = -1;

                    }
                }
                return $temp_array;
            }); //end of transaction

            //$temp = json_encode($products);
            //return "$quotation $temp";
            $new_quotation = true;
            return redirect('quotations')->with('new_quotation', $new_quotation);
        }
        catch( PDOException $e )
        {
            return $e;
        }
        catch( Exception $e )
        {
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function show(Quotation $quotation)
    {
        return view('quotations.show')->with('quotation', $quotation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotation $quotation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $quotation)
    {
        //
    }
}
