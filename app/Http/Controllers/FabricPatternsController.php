<?php

namespace App\Http\Controllers;

use App\FabricPattern;
use Illuminate\Http\Request;

class FabricPatternsController extends Controller
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
        return view('fabrics.patterns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fabricPattern = new FabricPattern;
        $fabricPattern->name = $request->get('name');
        
        $fabricPattern->save();

        $new = "$fabricPattern->name";
        return redirect('/fabrics')->with('new_pattern', $new);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FabricPattern  $fabricPattern
     * @return \Illuminate\Http\Response
     */
    public function show(FabricPattern $fabricPattern)
    {
        return view('fabrics.patterns.edit')->with('fabric_pattern', $fabricPattern);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FabricPattern  $fabricPattern
     * @return \Illuminate\Http\Response
     */
    public function edit(FabricPattern $fabricPattern)
    {
        return view('fabrics.patterns.edit')->with('fabric_pattern', $fabricPattern);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FabricPattern  $fabricPattern
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FabricPattern $fabricPattern)
    {
        $fabricPattern->name = $request->get('name');
        
        $fabricPattern->save();

        $edited = "$fabricPattern->name";
        return redirect('/fabrics')->with('edited_pattern', $edited);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FabricPattern  $fabricPattern
     * @return \Illuminate\Http\Response
     */
    public function destroy(FabricPattern $fabricPattern)
    {
        $deleted = "$fabricPattern->name";
        
        $fabricPattern->delete();

        return redirect("/fabrics")->with('deleted_pattern', $deleted);
    }
}
