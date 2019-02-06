<?php

namespace App\Http\Controllers;

use DB;
use App\Quotation;
use App\Quotation_Product;
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
            DB::transaction(function()  use ($request) {
                
                $quotation = new Quotation;
                $quotation->client = $request->get('client');
                $quotation->date_created = $request->get('date_created');
                
                $products = $request->get('product');
                $prices = $request->get('price');
                $descriptions = $request->get('description');
                
                $quotation->product_count = count($products);
                
                $quotation->save();

                
                foreach ($products as $key => $value) {
                    $product = new Quotation_Product;

                    $product->quotation = $quotation->id;
                    $product->product = $products[$key];
                    $product->price = substr($prices[$key],4);
                    $product->description = $descriptions[$key];
                    
                    $product->save();
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

        
        $products = Quotation_Product::join('product', 'product.id', '=', 'quotation_product.product')
            ->join('garment','garment.id', '=','product.garment')
            ->select('quotation_product.*',
                    DB::raw("
                        CONCAT('(',product.style_number,') ',garment.name, ' - ', product.description) AS product_temp_name
                    "))
            ->where('quotation_product.quotation', '=', $id)
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $quotation)
    {
        $deleted = "$quotation->id";
        
        $quotation->delete();

        return redirect("quotations")->with('deleted', $deleted);
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
            ->select('quotation.*','client.tin',
                    DB::raw("
                        CONCAT(client.last_name,', ',client.first_name,' ',IF( ISNULL(client.middle_name),'', CONCAT(LEFT(client.middle_name, 1),'.'))) AS full_name,
                        client.company_name,
                        CONCAT_WS(', ',address_line, address_municipality, address_province) AS address
                    "))
            ->where('quotation.id', '=', $id)
            ->get();

            $products = Product::join('garment', 'garment.id', '=', 'product.garment')
            ->join('fabric', 'fabric.id', '=', 'product.fabric')
            ->select('product.id','product.garment as garment_id','garment.name as garment', 'product.fabric as fabric_id','fabric.name as fabric', 'product.unit_price', 'product.description')
            ->where('product.quotation', '=', $id)
            ->get();

        return view('orders.select')->with('quotation', $quotation[0])->with('products',$products);
    }
}
