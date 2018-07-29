<?php

namespace App\Http\Controllers;

use App\Fabric;
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
        return redirect('/fabrics_and_status');
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
        
        return redirect('/fabrics_and_status')->with('new_fabric', $new_fabric);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fabric  $fabric
     * @return \Illuminate\Http\Response
     */
    public function show(Fabric $fabric)
    {
        //
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

        return redirect('/fabrics_and_status')->with('edited_fabric', $edited_fabric);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fabric  $fabric
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fabric $fabric)
    {
        //
    }

    /**
     * Get the list
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_fabric_list(Request $request)
    {
        $fabric = \App\Fabric::select('id','name AS text')->get();

        return response()->json($fabric);
    }
}
