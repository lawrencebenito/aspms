<?php

namespace App\Http\Controllers;

use DB;
use App\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::select(
                    'id','company_name','last_name','first_name','contact_num','email_address')
                    ->get();
        return view('clients.index')->with('client', $client);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new Client;
        $client->company_name = $request->get('company_name');
        $client->last_name = $request->get('last_name');
        $client->first_name = $request->get('first_name');
        $client->middle_name = $request->get('middle_name');
        $client->contact_num = $request->get('contact_num');
        $client->email_address = $request->get('email_address');
        $client->address_line = $request->get('address_line');
        $client->address_municipality = $request->get('address_municipality');
        $client->address_province = $request->get('address_province');
        
        $client->save();
        $new_client = "$client->first_name $client->last_name";
        
        return redirect('clients')->with('new_client', $new_client);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('clients.show')->with('client', $client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit')->with('client', $client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {    
        $client->company_name = $request->get('company_name');
        $client->last_name = $request->get('last_name');
        $client->first_name = $request->get('first_name');
        $client->middle_name = $request->get('middle_name');
        $client->contact_num = $request->get('contact_num');
        $client->email_address = $request->get('email_address');
        $client->address_line = $request->get('address_line');
        $client->address_municipality = $request->get('address_municipality');
        $client->address_province = $request->get('address_province');
        $client->active = $request->get('active');

        $client->save();
        $edited_client = "$client->first_name $client->last_name";

        return redirect("clients/$client->id")->with('edited_client', $edited_client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }

    /**
     * Get request with possible query
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_client_list(Request $request)
    {
        if ($request->has('q')) {
            $q = $request->input('q');

            $client = Client::select('id',DB::raw("CONCAT(last_name,', ',first_name,' ',IF( ISNULL(middle_name),'', CONCAT(LEFT(middle_name, 1),'.'))) AS text"))
                        ->where('active', '1')
                        ->where(function ($query) use(&$q) {
                            $query->where('last_name', 'like', '%' .$q. '%')
                                  ->orwhere('first_name', 'like', '%' .$q. '%')
                                  ->orwhere('middle_name', 'like', '%' .$q. '%');
                        })
                        ->get();

        }else{
            $client = Client::select('id',DB::raw("CONCAT(last_name,', ',first_name,' ',IF( ISNULL(middle_name),'', CONCAT (LEFT(middle_name, 1),'.'))) AS text"))
                            ->where('active', '1')
                            ->get();
        }

        return response()->json($client);
    }

    /**
     * Get request with possible query
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_client_info(Request $request)
    {
        $id = $request->input('id');

        $client = Client::select(DB::raw("company_name, CONCAT_WS(', ',address_line, address_municipality, address_province) AS address"))
                            ->where('id', $id)
                            ->get();
                            
        return response()->json($client);
    }
}
