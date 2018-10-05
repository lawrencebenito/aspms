<?php

namespace App\Http\Controllers;

use App\FabricType;
use Illuminate\Http\Request;

class FabricTypesController extends Controller
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
        return view('fabrics.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fabricType = new FabricType;
        $fabricType->name = $request->get('name');
        
        $fabricType->save();

        $new = "$fabricType->name";
        return redirect('/fabrics')->with('new_type', $new);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FabricType  $fabricType
     * @return \Illuminate\Http\Response
     */
    public function show(FabricType $fabricType)
    {
        return view('fabrics.types.edit')->with('fabric_type', $fabricType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FabricType  $fabricType
     * @return \Illuminate\Http\Response
     */
    public function edit(FabricType $fabricType)
    {
        return view('fabrics.types.edit')->with('fabric_type', $fabricType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FabricType  $fabricType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FabricType $fabricType)
    {
        $fabricType->name = $request->get('name');
        
        $fabricType->save();

        $edited = "$fabricType->name";
        return redirect('/fabrics')->with('edited_type', $edited);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FabricType  $fabricType
     * @return \Illuminate\Http\Response
     */
    public function destroy(FabricType $fabricType)
    {
        $deleted = "$fabricType->name";
        
        $fabricType->delete();

        return redirect("/fabrics")->with('deleted_type', $deleted);
    }

    /**
     * Get request with possible query
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_fabric_type_list(Request $request)
    {
        if ($request->has('q')) {
            $q = $request->input('q');

            $type = FabricType::select('id','name AS text')->where('name', 'like', '%' .$q. '%')->get();

        }else{
            $type = FabricType::select('id','name AS text')->get();
        }

        return response()->json($type);
    }
}
