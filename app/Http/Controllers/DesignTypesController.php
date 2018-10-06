<?php

namespace App\Http\Controllers;

use App\DesignType;
use Illuminate\Http\Request;

class DesignTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/designs');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('designs.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $designType = new DesignType;
        $designType->name = $request->get('name');
        
        $designType->save();

        $new = "$designType->name";
        return redirect('/designs')->with('new_type', $new);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DesignType  $designType
     * @return \Illuminate\Http\Response
     */
    public function show(DesignType $designType)
    {
        return view('designs.types.edit')->with('design_type', $designType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DesignType  $designType
     * @return \Illuminate\Http\Response
     */
    public function edit(DesignType $designType)
    {
        return view('designs.types.edit')->with('design_type', $designType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DesignType  $designType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DesignType $designType)
    {
        $designType->name = $request->get('name');
        
        $designType->save();

        $edited = "$designType->name";
        return redirect('/designs')->with('edited_type', $edited);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DesignType  $designType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DesignType $designType)
    {
        $deleted = "$designType->name";
        
        $designType->delete();

        return redirect("/designs")->with('deleted_type', $deleted);
    }

    /**
     * Get request with possible query
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list_design_types(Request $request)
    {
        if ($request->has('q')) {
            $q = $request->input('q');

            $list = DesignType::select('id','name AS text')
                        ->where('name', 'like', '%' .$q. '%')
                        ->get();
        }else{
            $list = DesignType::select('id','name AS text')->get();
        }

        return response()->json($list);
    }
}
