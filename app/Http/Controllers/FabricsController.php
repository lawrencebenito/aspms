<?php

namespace App\Http\Controllers;

use App\Fabric;
use App\FabricType;
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
        $fabric = Fabric::select('id')->get();
        
        return view('fabrics.index')->with('type', $type)->with('fabric', $fabric);
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
        $fabric = new fabric;
        $fabric->name = $request->get('name');
        
        $fabric->save();
        $new_fabric = "$fabric->name";
        
        return redirect('/garments_and_fabrics')->with('new_fabric', $new_fabric);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fabric  $fabric
     * @return \Illuminate\Http\Response
     */
    public function show(Fabric $fabric)
    {
        return view('fabrics.edit')->with('fabric', $fabric);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fabric  $fabric
     * @return \Illuminate\Http\Response
     */
    public function edit(Fabric $fabric)
    {
        return view('fabrics.edit')->with('fabric', $fabric);
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
        $fabric->name = $request->get('name');
        
        $fabric->save();
        $edited_fabric = "$fabric->name";

        return redirect('/garments_and_fabrics')->with('edited_fabric', $edited_fabric);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fabric  $fabric
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fabric $fabric)
    {
        $deleted = "$fabric->name";
        
        $fabric->delete();

        return redirect("/garments_and_fabrics")->with('deleted_fabric', $deleted);
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
