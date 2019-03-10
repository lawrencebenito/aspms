<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use Carbon\Carbon;
use DB;

class CompanyController extends Controller
{
    public function create(Request $request)
    {
    	$checkCompany = Company::all();
    	$hasRecords = 0;
    	

    	foreach ($checkCompany as $key => $value) {
    		$hasRecords = 1;
    	}
    	
    	if ($hasRecords == 1) {
    		$company = Company::all();
    		return view('salesorder.company_index')->with('company',$company[0]);
    	}
    	else
    	{
    		return view('salesorder.company_create');
    	}
    }

    public function save(Request $request)
    {
    	$hasErrors = 0;
    	$company_id = 'COMP0000'.DB::table('company')->count();
		try {
    		$company = new Company();
    		$company->company_id = $company_id;
    		$company->company_name = $request->companyname;
    		$company->company_address = $request->address;
    		$company->province = $request->province;
    		$company->city = $request->city;
    		$company->zipcode = $request->zip;
    		$company->contact_no = $request->contactno;
    		$company->emailaddress = $request->email;
    		$company->companyTIN = $request->tin;
    		$company->created_at = Carbon::now();
    		$company->updated_at = Carbon::now();

    		if($request->file('image')) 
            {
                $image = $request->file('image');
                $company->logo = $request->title.$image->getClientOriginalName();
                $image->move('uploads', $request->title.$image->getClientOriginalName());
                $company->save();
            }
            else
            {
                $company->logo = "default.png";
                $company->save();
            }
    	} catch (Exception $e) {
    		$hasErrors == 1;
    	}

    	return $hasErrors;


    }

    public function update(Request $request)
    {
    	$hasErrors = 0;
    	$company_id = $request->company_id;
		try {
			Company::findOrFail($company_id)->update([
				'company_name' => $request->companyname,
				'company_address' => $request->address,
				'province' => $request->province,
				'city' => $request->city,
				'zipcode' => $request->zip,
				'contact_no' => $request->contactno,
				'emailaddress' => $request->email,
				'companyTIN' => $request->tin,
				'updated_at' => Carbon::now(),
			]);
    	} catch (Exception $e) {
    		$hasErrors == 1;
    	}

    	return $hasErrors;
    }
}
