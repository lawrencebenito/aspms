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
                                CONCAT(client.last_name,
                                ', ',
                                client.first_name,
                                ' ',
                                IF(ISNULL(client.middle_name),
                                    '',
                                    CONCAT(LEFT(client.middle_name, 1), '.')),
                                IF(ISNULL(client.company_name),
                                    '',
                                    CONCAT(' of ', client.company_name))
                                ) AS client_name
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
        $id = $product->id;
        $product = Product::join('client', 'client.id', '=', 'product.client')
            ->join('garment','garment.id', '=', 'product.garment')
            ->select('product.*','garment.name AS garment_type',
                        DB::raw("
                        CONCAT(client.last_name,
                        ', ',
                        client.first_name,
                        ' ',
                        IF(ISNULL(client.middle_name),
                            '',
                            CONCAT(LEFT(client.middle_name, 1), '.')),
                        IF(ISNULL(client.company_name),
                            '',
                            CONCAT(' of ', client.company_name))
                        ) AS client_name
                        ")
                    )
            ->where('product.id', '=', $id)
            ->get();
            
        function checkSize($data)
        {
            if($data === 0){ return "Free Size"; }
            else if($data === 1){ return "XXS"; }
            else if($data === 2){ return "Extra Small"; }
            else if($data === 3){ return "Small"; }
            else if($data === 4){ return "Medium"; }
            else if($data === 5){ return "Large"; }
            else if($data === 6){ return "Extra Large"; }
            else if($data === 7){ return "XXL"; }
            else if($data === 8){ return "XXXL"; }
            else{
                return "Error. Check index.blade.php";
            }
        }

        $product[0]->min_range = checkSize($product[0]->min_range);
        $product[0]->max_range = checkSize($product[0]->max_range);
        $product[0]->consumption_size = checkSize($product[0]->consumption_size);
        $product[0]->total_price = number_format((float)$product[0]->total_price, 2, '.', '');

        $fabrics = Product_Fabric::join('segment', 'segment.id', '=', 'product_fabric.segment')
            ->join('fabric','fabric.id', '=', 'product_fabric.fabric')
            ->join('fabric_type', 'fabric_type.id', '=', 'fabric.type')
            ->join('fabric_pattern','fabric_pattern.id', '=','pattern')
            ->select('segment.name AS segment_name', 'fabric.*','fabric_type.name AS type_name','fabric_pattern.name AS pattern_name')
            ->where('product_fabric.product', '=', $id)
            ->get();

        $accessories = Product_Accessory::join('accessory', 'accessory.id', '=', 'product_accessory.accessory')
            ->join('accessory_type', 'accessory_type.id', '=', 'accessory.accessory_type')
            ->select('product_accessory.*','accessory.*','accessory_type.name AS type_name')
            ->where('product_accessory.product', '=', $id)
            ->get();
        
        $designs = Product_Design::join('design', 'design.id', '=', 'product_design.design')
            ->join('design_type', 'design_type.id', '=', 'design.design_type')
            ->select('product_design.*','design.*','design_type.name AS type_name')
            ->where('product_design.product', '=', $id)
            ->get();

        return view('products.show')
                ->with('product', $product[0])
                ->with('fabrics', $fabrics)
                ->with('accessories', $accessories)
                ->with('designs', $designs)
                ;
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

    /**
     * Get request with possible query
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list_products(Request $request)
    {
        $client_id = $request->get('id');
        
        if ($request->has('q') && (strlen($request->input('q')) > 0)) {
            $q = $request->input('q');

            $product = Product::join('garment','garment.id', '=','product.garment')
                        ->select('product.id',
                                DB::raw("
                                    CONCAT('(',product.style_number,') ',garment.name) AS text
                                ")
                        )
                        ->where('product.client', '=', $client_id)
                        ->where(function($query) use ($q){
                            $query->where('product.style_number', 'like', "%$q%");
                            $query->orWhere('garment.name', 'like', "%$q%");
                        })
                        ->get();
        }else{
            $product = Product::join('garment','garment.id', '=','product.garment')
                        ->select('product.id',
                                DB::raw("
                                    CONCAT('(',product.style_number,') ',garment.name) AS text
                                ")
                        )
                        ->where('product.client', '=', $client_id)
                        ->get();
        }
        
        return response()->json($product);
    }

    /**
     * Get request with possible query
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_product_info(Request $request)
    {
        $id = $request->input('id');

        $product = Product::join('client', 'client.id', '=', 'product.client')
            ->join('garment','garment.id', '=', 'product.garment')
            ->select('product.*','garment.name AS garment_type',
                        DB::raw("
                        CONCAT(client.last_name,
                        ', ',
                        client.first_name,
                        ' ',
                        IF(ISNULL(client.middle_name),
                            '',
                            CONCAT(LEFT(client.middle_name, 1), '.')),
                        IF(ISNULL(client.company_name),
                            '',
                            CONCAT(' of ', client.company_name))
                        ) AS client_name
                        ")
                    )
            ->where('product.id', '=', $id)
            ->get();
            
        function checkSize($data)
        {
            if($data === 0){ return "Free Size"; }
            else if($data === 1){ return "XXS"; }
            else if($data === 2){ return "Extra Small"; }
            else if($data === 3){ return "Small"; }
            else if($data === 4){ return "Medium"; }
            else if($data === 5){ return "Large"; }
            else if($data === 6){ return "Extra Large"; }
            else if($data === 7){ return "XXL"; }
            else if($data === 8){ return "XXXL"; }
            else{
                return "Error. Check index.blade.php";
            }
        }

        $product[0]->min_range = checkSize($product[0]->min_range);
        $product[0]->max_range = checkSize($product[0]->max_range);
        $product[0]->consumption_size = checkSize($product[0]->consumption_size);
        $product[0]->total_price = number_format((float)$product[0]->total_price, 2, '.', '');

        $fabrics = Product_Fabric::join('segment', 'segment.id', '=', 'product_fabric.segment')
            ->join('fabric','fabric.id', '=', 'product_fabric.fabric')
            ->join('fabric_type', 'fabric_type.id', '=', 'fabric.type')
            ->join('fabric_pattern','fabric_pattern.id', '=','pattern')
            ->select('segment.name AS segment_name', 'fabric.color', 'fabric.reference_num','fabric_type.name AS type_name','fabric_pattern.name AS pattern_name')
            ->where('product_fabric.product', '=', $id)
            ->get();

        $accessories = Product_Accessory::join('accessory', 'accessory.id', '=', 'product_accessory.accessory')
            ->join('accessory_type', 'accessory_type.id', '=', 'accessory.accessory_type')
            ->select('product_accessory.*','accessory.*','accessory_type.name AS type_name')
            ->where('product_accessory.product', '=', $id)
            ->get();
        
        $designs = Product_Design::join('design', 'design.id', '=', 'product_design.design')
            ->join('design_type', 'design_type.id', '=', 'design.design_type')
            ->select('product_design.*','design.*','design_type.name AS type_name')
            ->where('product_design.product', '=', $id)
            ->get();
        

        $price = "Php ".$product[0]->total_price;

        $prod_desc = "## Fabrics ##\n";
        foreach ($fabrics as $fabric) {
            $prod_desc .= "> $fabric->segment_name - $fabric->color $fabric->pattern_name $fabric->type_name ($fabric->reference_num)\n";
        }
        if(count($accessories)>0){
            $prod_desc .= "\n## Accessories ##\n";
            foreach($accessories as $accessory){
                $prod_desc .= "> $accessory->color $accessory->type_name \n";
            }   
        }
        if(count($designs)>0){
            $prod_desc .= "\n## Designs ##\n";
            foreach($designs as $design){
                $prod_desc .= "> $design->type_name - $design->actual_size - $design->location \n";
            }
            
        }

        //PHP Object to be converted to JSON
        $info = array("price"=>$price,
                    "product_description"=>$prod_desc);
    

        return response()->json($info);
    }
}
