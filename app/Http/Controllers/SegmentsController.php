<?php

namespace App\Http\Controllers;

use App\Segment;
use Illuminate\Http\Request;

class SegmentsController extends Controller
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
        return view('garments.segments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $segment = new Segment;
        $segment->name = $request->get('name');
        
        $segment->save();

        $new = "$segment->name";
        return redirect('/garments')->with('new_segment', $new);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Segment  $segment
     * @return \Illuminate\Http\Response
     */
    public function show(Segment $segment)
    {
        return view('garments.segments.edit')->with('segment', $segment);;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Segment  $segment
     * @return \Illuminate\Http\Response
     */
    public function edit(Segment $segment)
    {
        return view('garments.segments.edit')->with('segment', $segment);;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Segment  $segment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Segment $segment)
    {
        $segment->name = $request->get('name');
        
        $segment->save();

        $edited = "$segment->name";
        return redirect('/garments')->with('edited_segment', $edited);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Segment  $segment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Segment $segment)
    {
        $deleted = "$segment->name";
        
        $segment->delete();

        return redirect("/garments")->with('deleted_segment', $deleted);
    }
}
