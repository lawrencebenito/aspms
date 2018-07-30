<?php

namespace App\Http\Controllers;

use App\Garment;
use Illuminate\Http\Request;

class GarmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/garments_and_operations');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('garments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $garment = new Garment;
        $garment->name = $request->get('name');
        
        $garment->save();
        $new_garment = "$garment->name";
        
        return redirect('/garments_and_operations')->with('new_garment', $new_garment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Garment  $garment
     * @return \Illuminate\Http\Response
     */
    public function show(Garment $garment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Garment  $garment
     * @return \Illuminate\Http\Response
     */
    public function edit(Garment $garment)
    {
        return view('garments.edit')->with('garment', $garment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Garment  $garment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Garment $garment)
    {
        $garment->name = $request->get('name');
        $garment->active = $request->get('active');
        
        $garment->save();
        $edited_garment = "$garment->name";

        return redirect('/garments_and_operations')->with('edited_garment', $edited_garment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Garment  $garment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Garment $garment)
    {
        //
    }

    /**
     * Get the list
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_garment_list(Request $request)
    {
        $garment = \App\Garment::select('id','name AS text')->get();

        return response()->json($garment);
    }
}