<?php

namespace App\Http\Controllers;

use App\AccessoryType;
use Illuminate\Http\Request;

class AccessoryTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/accessories');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accessories.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $accessoryType = new AccessoryType;
        $accessoryType->name = $request->get('name');
        
        $accessoryType->save();

        $new = "$accessoryType->name";
        return redirect('/accessories')->with('new_type', $new);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AccessoryType  $accessoryType
     * @return \Illuminate\Http\Response
     */
    public function show(AccessoryType $accessoryType)
    {
        return view('accessories.types.edit')->with('accessory_type', $accessoryType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AccessoryType  $accessoryType
     * @return \Illuminate\Http\Response
     */
    public function edit(AccessoryType $accessoryType)
    {
        return view('accessories.types.edit')->with('accessory_type', $accessoryType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AccessoryType  $accessoryType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccessoryType $accessoryType)
    {
        $accessoryType->name = $request->get('name');
        
        $accessoryType->save();

        $edited = "$accessoryType->name";
        return redirect('/accessories')->with('edited_type', $edited);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AccessoryType  $accessoryType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccessoryType $accessoryType)
    {
        $deleted = "$accessoryType->name";
        
        $accessoryType->delete();

        return redirect("/accessories")->with('deleted_type', $deleted);
    }

    /**
     * Get request with possible query
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_accessory_type_list(Request $request)
    {
        if ($request->has('q')) {
            $q = $request->input('q');

            $type = AccessoryType::select('id','name AS text')->where('name', 'like', '%' .$q. '%')->get();

        }else{
            $type = AccessoryType::select('id','name AS text')->get();
        }

        return response()->json($type);
    }
}
