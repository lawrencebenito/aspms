<?php

namespace App\Http\Controllers;

use DB;
use App\Garment;
use App\Segment;
use App\Operation;
use App\GarmentSegment;
use App\GarmentOperation;
use App\GarmentFabric;

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
        $garment = Garment::select('id','name')->get();
        
        // $segment_count = Garment::leftjoin('garment_segment', 'garment.id', '=', 'garment_segment.garment')
        //                     ->select(DB::raw("count(garment_segment.garment) AS segment_count"))
        //                     ->groupBy('garment.id')
        //                     ->get();
        // $operation_count = Garment::leftjoin('garment_operation', 'garment.id', '=', 'garment_operation.garment')
        //                 ->select(DB::raw("count(garment_operation.garment) AS segment_count"))
        //                 ->groupBy('garment.id')
        //                 ->get();

        // $fabric_count = Garment::leftjoin('garment_fabric', 'garment.id', '=', 'garment_fabric.garment')
        //                 ->select(DB::raw("count(garment_fabric.garment) AS segment_count"))
        //                 ->groupBy('garment.id')
        //                 ->get();
        
        $segment = Segment::select('id','name')->get();
        $operation = Operation::select('id','name')->get();
        
        return view('garments.index')
            ->with('garment', $garment)
            ->with('segment', $segment)
            ->with('operation', $operation);
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
        
        DB::transaction(function()  use ($request, $garment) {
                
            $garment->save();
            $id = $garment->id;
            $segments = $request->get('segments');
            $operations = $request->get('operations');
            $fabrics = $request->get('fabrics');
            
            foreach ($segments as $segment) {
                $obj = new GarmentSegment;
                $obj->garment = $id;
                $obj->segment = $segment;
                $obj->save();
            }
            
            foreach ($operations as $operation) {
                $obj = new GarmentOperation;
                $obj->garment = $id;
                $obj->operation = $operation;
                $obj->save();
            }
            
            foreach ($fabrics as $fabric) {
                $obj = new GarmentFabric;
                $obj->garment = $id;
                $obj->fabric = $fabric;
                $obj->save();
            }
        }); //end of transaction
        
        $new_garment = "$garment->name";
        
        return redirect('/garments')->with('new_garment', $new_garment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Garment  $garment
     * @return \Illuminate\Http\Response
     */
    public function show(Garment $garment)
    {
        $id = $garment->id;

        $segment_list = Garment::leftjoin('garment_segment', 'garment.id', '=', 'garment_segment.garment')
                            ->join('segment', 'segment.id', '=', 'garment_segment.segment')
                            ->select('segment.name')
                            ->where('garment.id', $id)
                            ->get();
        $operation_list = Garment::leftjoin('garment_operation', 'garment.id', '=', 'garment_operation.garment')
                            ->join('operation', 'operation.id', '=', 'garment_operation.operation')
                            ->select('operation.name')
                            ->where('garment.id', $id)
                            ->get();
        $fabric_list = Garment::leftjoin('garment_fabric', 'garment.id', '=', 'garment_fabric.garment')
                            ->join('fabric_type', 'fabric_type.id', '=', 'garment_fabric.fabric')
                            ->select('fabric_type.name')
                            ->where('garment.id', $id)
                            ->get();
        
        return view('garments.show')
                ->with('garment', $garment)
                ->with('segment_list', $segment_list)
                ->with('operation_list', $operation_list)
                ->with('fabric_list', $fabric_list);
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

        return redirect('/garments_and_fabrics')->with('edited_garment', $edited_garment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Garment  $garment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Garment $garment)
    {
        $deleted = "$garment->name";
        
        $garment->delete();

        return redirect("/garments")->with('deleted_garment', $deleted);
    }

    /**
     * Get request with possible query
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_garment_list(Request $request)
    {
        if ($request->has('q')) {
            $q = $request->input('q');

            $garment = \App\Garment::select('id','name AS text')
                        ->where('name', 'like', '%' .$q. '%')
                        ->get();
        }else{
            $garment = \App\Garment::select('id','name AS text')->get();
        }
        
        return response()->json($garment);
    }
}
