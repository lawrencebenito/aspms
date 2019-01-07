<?php

namespace App\Http\Controllers;

use DB;
use App\Design;
use App\DesignType;
use App\DesignPrice;
use Illuminate\Http\Request;

class DesignsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = DesignType::select('id','name')->get();
        $design = Design::join('design_type', 'design_type.id', '=', 'design.design_type')
                        ->select('design.*','design_type.name AS type_name')
                        ->get();

        return view('designs.index')->with('type',$type)->with('design',$design);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('designs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $design = new Design;

        $design->design_type = $request->get('design_type');
        $design->supplier = $request->get('supplier');
        $design->category_size = $request->get('category_size');
        $design->size_range = $request->get('size_range');
        $design->color_count = $request->get('color_count');
        
        DB::transaction(function()  use ($request, $design) {
                
            $design->save();
            $design_id = $design->id;

            $design_price = new DesignPrice;

            $design_price->design = $design_id;
            $design_price->date_effective = $request->get('date_effective');
            $design_price->unit_price = $request->get('unit_price');
            
            $design_price->save();
            
        }); //end of transaction        

        return redirect('/designs')->with('new_design', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function show(Design $design)
    {
        $id = $design->id;

        $design = Design::join('design_type', 'design_type.id', '=', 'design.design_type')
                        ->select('design.*','design_type.name AS type_name')
                        ->where('design.id', $id)
                        ->get();

        $design_price = DesignPrice::join('design', 'design.id', '=', 'design')
                        ->select('design_price.*')
                        ->where('design_price.design', $id)
                        ->limit(1)
                        ->orderBy('design_price.date_effective','DESC')
                        ->get();
                        
        return view('designs.show')
                ->with('design', $design[0])
                ->with('design_price', $design_price[0])
                ->with('latest_date', $design_price[0]->date_effective);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function edit(Design $design)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Design $design)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function destroy(Design $design)
    {
        $design->delete();

        return redirect("/designs")->with('deleted_design', true);
    }

    /**
     * Get request with possible query
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list_designs(Request $request)
    {
        $design = Design::join('design_type', 'design_type.id', '=', 'design.design_type')
                        ->join('design_price', 'design_price.design', '=', 'design.id')
                        ->select('design.*','design_type.name AS type_name','unit_price')
                        ->get();

        return response()->json($design);
    }
}
