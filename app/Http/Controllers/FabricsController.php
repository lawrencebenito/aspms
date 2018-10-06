<?php

namespace App\Http\Controllers;

use DB;
use App\Fabric;
use App\FabricType;
use App\FabricPattern;
use App\FabricPrice;
use Illuminate\Http\Request;

class FabricsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = FabricType::select('id','name')->get();
        $pattern = FabricPattern::select('id','name')->get();
        $fabric = Fabric::join('fabric_type', 'fabric_type.id', '=', 'fabric.type')
                        ->join('fabric_pattern','fabric_pattern.id', '=','pattern')
                        ->select('fabric.*','fabric_type.name AS type_name','fabric_pattern.name AS pattern_name')
                        ->get();
        
        return view('fabrics.index')
            ->with('type', $type)
            ->with('pattern', $pattern)
            ->with('fabric', $fabric);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fabrics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fabric = new Fabric;
        
        $fabric->color = $request->get('color');
        $fabric->pattern = $request->get('pattern');
        $fabric->type = $request->get('type');
        $fabric->supplier_name = $request->get('supplier_name');
        $fabric->reference_num = $request->get('reference_num');
        $fabric->fabrication = $request->get('fabrication');
        $fabric->gsm = $request->get('gsm');
        $fabric->width = $request->get('width');
        
        DB::transaction(function()  use ($request, $fabric) {
                
            $fabric->save();
            $fabric_id = $fabric->id;

            $fabric_price = new FabricPrice;

            $fabric_price->fabric = $fabric_id;
            $fabric_price->date_effective = $request->get('date_effective');
            $fabric_price->unit_price = $request->get('unit_price');
            $fabric_price->measurement_type = $request->get('measurement_type');
            
            $fabric_price->save();
            
        }); //end of transaction        

        $pattern_name = $request->get('pattern_name');
        $type_name = $request->get('type_name');
        $new_fabric = "$fabric->color $pattern_name $type_name";
        
        return redirect('/fabrics')->with('new_fabric', $new_fabric);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fabric  $fabric
     * @return \Illuminate\Http\Response
     */
    public function show(Fabric $fabric)
    {
        $id = $fabric->id;

        $fabric = Fabric::join('fabric_type', 'fabric_type.id', '=', 'fabric.type')
                        ->join('fabric_pattern','fabric_pattern.id', '=','pattern')
                        ->select('fabric.*','fabric_type.name AS type_name','fabric_pattern.name AS pattern_name')
                        ->where('fabric.id', $id)
                        ->get();

        $fabric_price = FabricPrice::join('fabric', 'fabric.id', '=', 'fabric')
                        ->select('fabric_price.*')
                        ->where('fabric_price.fabric', $id)
                        ->limit(1)
                        ->orderBy('fabric_price.date_effective','DESC')
                        ->get();
                        
        return view('fabrics.show')
                ->with('fabric', $fabric[0])
                ->with('fabric_price', $fabric_price[0])
                ->with('latest_date', $fabric_price[0]->date_effective);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fabric  $fabric
     * @return \Illuminate\Http\Response
     */
    public function edit(Fabric $fabric)
    {
        $fabric = Fabric::join('fabric_type', 'fabric_type.id', '=', 'fabric.type')
                        ->join('fabric_pattern','fabric_pattern.id', '=','pattern')
                        ->select('fabric.*','fabric_type.name AS type_name','fabric_pattern.name AS pattern_name')
                        ->where('fabric.id', $fabric->id)
                        ->get();

        return view('fabrics.edit')->with('fabric', $fabric[0]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fabric  $fabric
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fabric $fabric)
    {
        $fabric->color = $request->get('color');
        $fabric->pattern = $request->get('pattern');
        $fabric->type = $request->get('type');
        $fabric->supplier_name = $request->get('supplier_name');
        $fabric->reference_num = $request->get('reference_num');
        $fabric->fabrication = $request->get('fabrication');
        $fabric->gsm = $request->get('gsm');
        $fabric->width = $request->get('width');
        
        $fabric->save();

        $pattern_name = $request->get('pattern_name');
        $type_name = $request->get('type_name');
        $edited = "$fabric->color $pattern_name $type_name";

        return redirect("/fabrics/$fabric->id")->with('edited_fabric', $edited);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fabric  $fabric
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fabric $fabric)
    {        
        $fabric->delete();
        $deleted = true;

        return redirect("/fabrics")->with('deleted_fabric', $deleted);
    }

    /**
     * Get request with possible query
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_fabric_list(Request $request)
    {
        if ($request->has('q')) {
            $q = $request->input('q');

            $fabric = \App\Fabric::select('id','name AS text')
                        ->where('name', 'like', '%' .$q. '%')
                        ->get();
        }else{
            $fabric = \App\Fabric::select('id','name AS text')->get();
        }

        return response()->json($fabric);
    }
}
