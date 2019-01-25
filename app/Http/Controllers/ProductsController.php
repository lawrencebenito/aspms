<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use App\Product_Fabric;
use App\Product_Operation;
use App\Product_Accessory;
use App\Product_Design;
use Illuminate\Http\Request;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::join('client', 'client.id', '=', 'product.client')
                        ->join('garment','garment.id', '=','product.garment')
                        ->select('product.*', 'garment.name',
                                DB::raw("
                                    CONCAT(client.last_name,', ',client.first_name,' ',IF( ISNULL(client.middle_name),'', CONCAT(LEFT(client.middle_name, 1),'.')), ' of ', client.company_name) AS client_name
                                ")
                        )
                        ->get();
        
        return view('products.index')->with('product', $product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            DB::transaction(function () use ($request) {
                
                /** ============================== PRODUCT HEADER =============================== */
                $product = new Product;
                
                $product->date_created = $request->get('date_created');
                $product->garment = $request->get('garment');
                $product->client = $request->get('client');
                $product->description = $request->get('description');
                $product->min_range = $request->get('min_range');
                $product->max_range = $request->get('max_range');
                $product->consumption_size = $request->get('consumption_size');
                $product->markup = $request->get('markup');
                $product->total_price = $request->get('total_price');
    
                $product->save();
                $id = $product->id;

                $fixed_chars = "SN";
                $year = date("Y");
                
                $product->style_number = sprintf("%s%s%04d",$fixed_chars, $year, $id);
                $product->update();

                /** ============================== PRODUCT FABRIC =============================== */
                
                //Populates the arrayed "get requests" to variable arrays
                $segments = $request->get('segment');
                $fabrics = $request->get('fabric');
                $lengths = $request->get('length');
                $widths = $request->get('width');
                $pairs = $request->get('pair');
                $allowances = $request->get('allowance');

                //JUST FOR PRINTING AND DEBUGGING
                // foreach ($segments as $key => $value) {
                //     echo "Segment Order no. $key: $value | ";
                //     echo "Fabric Order no. $key: $fabrics[$key] | ";
                //     echo "Length: $lengths[$key] , Width: $widths[$key]  | ";
                //     echo "Pair?: $pairs[$key], Allowance: $allowances[$key] <br/>";
                // }

                foreach ($segments as $key => $value) {
                    $fabric = new Product_Fabric;
                    
                    $fabric->product = $id;
                    $fabric->segment = $segments[$key];
                    $fabric->fabric = $fabrics[$key];
                    $fabric->length = $lengths[$key];
                    $fabric->width = $widths[$key];
                    $fabric->is_pair = $pairs[$key];
                    $fabric->allowance = $allowances[$key];

                    $fabric->save();
                }
                
                /** ============================== PRODUCT OPERATIONS =============================== */

                //Populates the arrayed "get requests" to variable arrays
                $operations = $request->get('operation');
                $rates = $request->get('rate');

                foreach ($operations as $key => $value) {
                    $operation = new Product_Operation;
                    
                    $operation->product = $id;
                    $operation->operation = $operations[$key];
                    $operation->rate = $rates[$key];

                    $operation->save();
                }

                /** ============================== PRODUCT ACCESSORY =============================== */

                //Populates the arrayed "get requests" to variable arrays
                $accessories = $request->get('accessory');
                $quantities = $request->get('quantity');

                if ($accessories[0] !== null) {
                    foreach ($accessories as $key => $value) {
                        $accessory = new Product_Accessory;
                        
                        $accessory->product = $id;
                        $accessory->accessory = $accessories[$key];
                        $accessory->quantity = $quantities[$key];

                        $accessory->save();
                    }
                }//end if 

                /** ============================== PRODUCT DESIGN =============================== */

                //Populates the arrayed "get requests" to variable arrays
                # id, product, design, actual size, location, sample_image

                $designs = $request->get('design');
                $actual_sizes = $request->get('actual_size');
                $locations = $request->get('location');
                
                if ($designs[0] !== null) {
                    foreach ($designs as $key => $value) {
                        $design = new Product_Design;
                        
                        $design->product = $id;
                        $design->design = $designs[$key];
                        $design->actual_size = $actual_sizes[$key];
                        $design->location = $locations[$key];
    
                        $design->save();
                    }
                }//end if

            });//end transactions
        
            $new = true;
            return redirect('products')->with('new', $new);
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
