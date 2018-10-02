<?php

namespace App\Http\Controllers;

use App\Accessory;
use App\AccessoryType;
use Illuminate\Http\Request;

class AccessoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accessory = Accessory::join('accessory_type', 'accessory_type.id', '=', 'accessory.accessory_type')
                    ->select('accessory.*','accessory_type.name AS type_name')
                    ->get();
        $accessoryType = AccessoryType::all();

        return view('accessories.index')->with('accessory', $accessory)->with('type', $accessoryType);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accessories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $accessory = new Accessory;
        # id, accessory_type, description, color, supplier, reference_num

        $accessory->accessory_type = $request->get('type');
        $accessory->description = $request->get('description');
        $accessory->color = $request->get('color');
        $accessory->supplier = $request->get('supplier');
        $accessory->reference_num = $request->get('reference_num');
        
        // $products = DB::transaction(function()  use ($request, $fabric) {
                
            $accessory->save();
        //     $fabric_id = $fabric->id;

        //     $fabric_price = new FabricPrice;

        //     $fabric_price->fabric = $fabric_id;
        //     $fabric_price->date_effective = $request->get('date_effective');
        //     $fabric_price->unit_price = $request->get('unit_price');
        //     $fabric_price->measurement_type = $request->get('measurement_type');
            
        //     $fabric_price->save();
            
        // }); //end of transaction
        
        return redirect('/accessories')->with('new_accessory', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Accessory  $accessory
     * @return \Illuminate\Http\Response
     */
    public function show(Accessory $accessory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Accessory  $accessory
     * @return \Illuminate\Http\Response
     */
    public function edit(Accessory $accessory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Accessory  $accessory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accessory $accessory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Accessory  $accessory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accessory $accessory)
    {
        //
    }
}
