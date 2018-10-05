<?php

namespace App\Http\Controllers;

use App\FabricPrice;
use Illuminate\Http\Request;

class FabricPricesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/fabrics');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/fabrics');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fabric_price = new FabricPrice;
        $fabric_id = $request->get('fabric_id');
        
        $fabric_price->fabric = $fabric_id;
        $fabric_price->date_effective = $request->get('date_effective');
        $fabric_price->unit_price = $request->get('unit_price');
        $fabric_price->measurement_type = $request->get('measurement_type');
        
        $fabric_price->save();

        $updated = true;

        return redirect("./fabrics/$fabric_id")->with('price_updated', $updated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FabricPrice  $fabricPrice
     * @return \Illuminate\Http\Response
     */
    public function show(FabricPrice $fabricPrice)
    {
        return redirect('/fabrics');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $fabric_ids
     * @return \Illuminate\Http\Response
     */
    public function edit(int $fabric_id)
    {
       $fabric_price = FabricPrice::select('fabric_price.*')
                        ->where('fabric', $fabric_id)
                        ->orderBy('fabric_price.date_effective','DESC')
                        ->get();

        return view('fabrics.prices.edit')
                ->with('fabric_price',$fabric_price)
                ->with('fabric_id', $fabric_id)
                ->with('latest_date', $fabric_price[0]->date_effective);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FabricPrice  $fabricPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FabricPrice $fabricPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FabricPrice  $fabricPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(FabricPrice $fabricPrice)
    {
        //
    }
}
