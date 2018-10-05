<?php

namespace App\Http\Controllers;

use App\Worker;
use Illuminate\Http\Request;

class WorkersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $worker = Worker::select(
            'id','last_name','first_name','contact_number','address')
            ->get();
        return view('workers.index')->with('worker', $worker);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('workers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $worker = new Worker;
        $worker->last_name = $request->get('last_name');
        $worker->first_name = $request->get('first_name');
        $worker->middle_name = ($request->get('middle_name') ?: ' ');
        $worker->contact_number = $request->get('contact_number');
        $worker->email_address = ($request->get('email_address') ?: ' ');
        $worker->address = ($request->get('address') ?: ' ');
        
        $worker->save();
        $new_worker = "$worker->first_name $worker->last_name";
        
        return redirect('workers')->with('new_worker', $new_worker);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function show(Worker $worker)
    {
        return view('workers.show')->with('worker', $worker);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function edit(Worker $worker)
    {
        return view('workers.edit')->with('worker', $worker);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Worker $worker)
    {
        $worker->last_name = $request->get('last_name');
        $worker->first_name = $request->get('first_name');
        $worker->middle_name = ($request->get('middle_name') ?: ' ');
        $worker->contact_number = $request->get('contact_number');
        $worker->email_address = ($request->get('email_address') ?: ' ');
        $worker->address = ($request->get('address') ?: ' ');
        $worker->active = $request->get('active');
        
        $worker->save();        
        $edited_worker = "$worker->first_name $worker->last_name";

        return redirect("workers/$worker->id")->with('edited_worker', $edited_worker);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        $deleted = "$worker->first_name $worker->last_name";
        
        $worker->delete();

        return redirect("/workers")->with('deleted', $deleted);
    }
}
