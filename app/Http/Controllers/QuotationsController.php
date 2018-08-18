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
        
            $products = DB::transaction(function()  use ($request, $quotation) {
                
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
                    $product->save();
                    

                    if($fcount_index == ((int)$fcount)- 1){
                        $garment_index++;
                        $fcount_index = -1;

                    }
                }
            }); //end of transaction

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
        $id = $quotation->id;
        $quotation = Quotation::join('client', 'client.id', '=', 'quotation.client')
            ->select('quotation.*',
                    DB::raw("
                        CONCAT(client.last_name,', ',client.first_name,' ',IF( ISNULL(client.middle_name),'', CONCAT(LEFT(client.middle_name, 1),'.'))) AS full_name,
                        client.company_name,
                        CONCAT_WS(', ',address_line, address_municipality, address_province) AS address
                    "))
            ->where('quotation.id', '=', $id)
            ->get();

        $products = Product::join('garment', 'garment.id', '=', 'product.garment')
            ->join('fabric', 'fabric.id', '=', 'product.fabric')
            ->select('product.id', 'garment.name as garment', 'fabric.name as fabric', 'product.unit_price', 'product.description')
            ->where('product.quotation', '=', $id)
            ->get();

        return view('quotations.show')->with('quotation', $quotation[0])->with('products',$products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
    {
        $id = $quotation->id;
        $quotation = Quotation::join('client', 'client.id', '=', 'quotation.client')
            ->select('quotation.*',
                    DB::raw("
                        CONCAT(client.last_name,', ',client.first_name,' ',IF( ISNULL(client.middle_name),'', CONCAT(LEFT(client.middle_name, 1),'.'))) AS full_name,
                        client.company_name,
                        CONCAT_WS(', ',address_line, address_municipality, address_province) AS address
                    "))
            ->where('quotation.id', '=', $id)
            ->get();

        $products = Product::join('garment', 'garment.id', '=', 'product.garment')
            ->join('fabric', 'fabric.id', '=', 'product.fabric')
            ->select('product.garment as garment_id','garment.name as garment', 'product.fabric as fabric_id','fabric.name as fabric', 'product.unit_price', 'product.description')
            ->where('product.quotation', '=', $id)
            ->get();

        return view('quotations.edit')->with('quotation', $quotation[0])->with('products',$products);
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
        return "trying to update the form";
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

    /**
     * Show the form for ordering the quotation.
     *
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function order(Quotation $quotation)
    {
        $id = $quotation->id;
        $quotation = Quotation::join('client', 'client.id', '=', 'quotation.client')
            ->select('quotation.*',
                    DB::raw("
                        CONCAT(client.last_name,', ',client.first_name,' ',IF( ISNULL(client.middle_name),'', CONCAT(LEFT(client.middle_name, 1),'.'))) AS full_name,
                        client.company_name,
                        CONCAT_WS(', ',address_line, address_municipality, address_province) AS address
                    "))
            ->where('quotation.id', '=', $id)
            ->get();

        $products = Product::join('garment', 'garment.id', '=', 'product.garment')
            ->join('fabric', 'fabric.id', '=', 'product.fabric')
            ->select('product.id', 'garment.name as garment', 'fabric.name as fabric', 'product.unit_price', 'product.description')
            ->where('product.quotation', '=', $id)
            ->get();

        // return view('quotations.edit')->with('quotation', $quotation[0])->with('products',$products);
        return "Ordering the cool quotation -> $quotation with its products <br /> $products";
    }
}
