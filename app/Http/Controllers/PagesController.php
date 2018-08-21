<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
    }

    public function garments_and_fabrics(){
        $garment = \App\Garment::select('id','name')->get();
        $fabric = \App\Fabric::select('id','name')->get();
        
        return view('pages.garments_and_fabrics')->with('garment', $garment)->with('fabric', $fabric);
    }
    
    public function operations_and_status(){
        $operation = \App\Operation::select('id','name')->get();
        $status = \App\Status::select('id','description')->get();

        return view('pages.operations_and_status')->with('operation',$operation)->with('status',$status);
    }

    public function orders(){
        return view('orders.mockindex');
    }

    public function job_orders(){
        return view('job_orders.index');
    }

    public function about(){
        $title = "About Us";
        return view('pages.about')->with('title', $title);
    }

    public function services(){
        $data = array(
            'title' => 'Services Page',
            'services' => ['Web Design', 'Programming', 'SEO']
        );
        return view('pages.services')->with($data);
    }
}
