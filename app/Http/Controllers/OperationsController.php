<?php

namespace App\Http\Controllers;

use App\Operation;
use Illuminate\Http\Request;

class OperationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/garments');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('garments.operations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $operation = new Operation;
        $operation->name = $request->get('name');
        
        $operation->save();
        $new_operation = "$operation->name";
        
        return redirect('/garments')->with('new_operation', $new_operation);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function show(Operation $operation)
    {
        return view('garments.operations.edit')->with('operation', $operation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function edit(Operation $operation)
    {
        return view('garments.operations.edit')->with('operation', $operation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operation $operation)
    {
        $operation->name = $request->get('name');
        
        $operation->save();        
        $edited_operation = "$operation->name";

        return redirect('/garments')->with('edited_operation', $edited_operation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operation $operation)
    {
        $deleted = "$operation->name";
        
        $operation->delete();

        return redirect("/garments")->with('deleted_operation', $deleted);
    }

    /**
     * Get request with possible query
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list_operations(Request $request)
    {
        if ($request->has('q')) {
            $q = $request->input('q');

            $list = Operation::select('id','name AS text')
                        ->where('name', 'like', '%' .$q. '%')
                        ->get();
        }else{
            $list = Operation::select('id','name AS text')->get();
        }

        return response()->json($list);
    }
}
