<?php

namespace App\Http\Controllers;

use DB;
use App\Accessory;
use App\AccessoryType;
use App\AccessoryPrice;
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

        $accessory->accessory_type = $request->get('type');
        $accessory->description = $request->get('description');
        $accessory->color = $request->get('color');
        $accessory->supplier = $request->get('supplier');
        $accessory->reference_num = $request->get('reference_num');
        
        DB::transaction(function()  use ($request, $accessory) {
                
            $accessory->save();
            $id = $accessory->id;

            $accessory_price = new AccessoryPrice;

            $accessory_price->accesory = $id;
            $accessory_price->date_effective = $request->get('date_effective');
            $accessory_price->price = $request->get('price');
            $accessory_price->measurement_type = $request->get('measurement_type');
            $accessory_price->quantity = $request->get('quantity');
            $accessory_price->unit_price = $request->get('unit_price');
            
            $accessory_price->save();
            
        }); //end of transaction
        
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
        $id = $accessory->id;

        $accessory = Accessory::join('accessory_type', 'accessory_type.id', '=', 'accessory.accessory_type')
                        ->select('accessory.*','accessory_type.name AS type_name')
                        ->where('accessory.id', $id)
                        ->get();

        $accessory_price = AccessoryPrice::join('accessory', 'accessory.id', '=', 'accesory')
                        ->select('accessory_price.*')
                        ->where('accessory_price.accesory', $id)
                        ->limit(1)
                        ->orderBy('accessory_price.date_effective','DESC')
                        ->get();
                        
        return view('accessories.show')
                ->with('accessory', $accessory[0])
                ->with('accessory_price', $accessory_price[0]);
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
        $accessory->delete();

        return redirect("/accessories")->with('deleted_accessory', true);
    }

    /**
     * Get request with possible query
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list_accessories(Request $request)
    {
        $accessory = Accessory::join('accessory_type', 'accessory_type.id', '=', 'accessory.accessory_type')
                ->join('accessory_price', 'accessory_price.accesory', '=', 'accessory.id')
                ->select('accessory.*','accessory_type.name AS type_name',
                'unit_price',
                'measurement_type',
                'date_effective')
                ->get();
                
        return response()->json($accessory);
    }

}
