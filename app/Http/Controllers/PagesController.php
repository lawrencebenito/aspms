<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
    }

    public function fabrics_and_status(){
        $fabric = \App\Fabric::select('id','name')->get();
        $status = \App\Status::select('id','description')->get();

        return view('pages.fabrics_and_status')->with('fabric', $fabric)->with('status',$status);
    }

    public function garments_and_operations(){
        $garment = \App\Garment::select('id','name')->get();
        $operation = \App\Operation::select('id','name')->get();

        return view('pages.garments_and_operations')->with('garment', $garment)->with('operation',$operation);
    }

    public function orders(){
        return view('orders.index');
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
