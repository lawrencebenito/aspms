@extends('layouts.main')

@push('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
<style type="text/css">
    .my-table {
        word-wrap: break-word; 
        table-layout:fixed;
        width: 100%;
        border-collapse: collapse;
    }
    .blank_row
    {
        height: 20px !important; /* overwrites any other rules */
    } 
    tr
    {
      height: 20px !important;
    }
  </style>
@endpush

@section('page_header')
  <i class="fa fa-shopping-cart"></i> Official Receipt
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Sales</a></li>
    <li class="active">Official Receipt</li>
  </ol>
@endsection
  
@section('content')
<div class="container-fluid" style="margin-left: 50px; margin-right: 50px;">
    <a href="/SalesOrder/payment/exportOR/{{$payment_no}}" class="btn btn-primary">Export PDF</a>
    <div class="row">
      <div class="col-md-4" style="margin-top: 20px;">

        <th style="border: 1px solid black; margin-top: 20px;">In settlement of the following</th>
        <table class="my-table" border="1">
          <thead style="border: 1px solid black;">
            <tr>
              <th style="border: 1px solid black;" width="50%">
                Particulars
              </th>
              <th style="border: 1px solid black;" width="40%">
                Amount
              </th>
              <th style="border: 1px solid black;" width="10%">
                
              </th>
            </tr>
          </thead>
          <tbody>
            <tr class="blank_row">
              <td></td> <td></td> <td></td>
            </tr>
            <tr class="blank_row">
              <td></td> <td></td> <td></td>
            </tr>
            <tr class="blank_row">
              <td></td> <td></td> <td></td>
            </tr>
            <tr class="blank_row">
              <td></td> <td></td> <td></td>
            </tr>
            <tr class="blank_row">
              <td></td> <td></td> <td></td>
            </tr>
            <tr>
              <td>Vat Zero-Rated Service</td> <td></td> <td></td>
            </tr>
            <tr>
              <td>Vat Exempt Service</td> <td></td> <td></td>
            </tr>
            <tr>
              <td>Vatable Service</td> <td></td> <td></td>
            </tr>
            <tr>
              <td>Value-Added Tax</td> <td></td> <td></td>
            </tr>
            <tr>
              <td>Gross Due PHP</td> <td></td> <td></td>
            </tr>
            <tr>
              <td>Withholding Tax</td> <td></td> <td></td>
            </tr>
            <tr>
              <td>Total Taxes</td> <td></td> <td></td>
            </tr>
            <tr>
              <td>Total Amount Due </td> <td></td> <td></td>
            </tr>
            <tr>
              <td align="center" colspan="3">FORM OF PAYMENT</td>
            </tr>
            <tr>
              <td   colspan="3">CASH</td>
            </tr>
            <tr>
              <td   colspan="3">CHECK</td>
            </tr>
            <tr>
              <td   colspan="3">BANK</td>
            </tr>
            <tr>
              <td   colspan="3">CHECK NO.</td>
            </tr>
            <tr>
              <td   colspan="3">CHECK DATE</td>
            </tr>
            <tr>
              <td   colspan="3">AMOUNT</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-8">
        <div class="row" style="text-align: center;">
          <h3>{{$company->company_name}}</h3>
          {{$company->company_address}}, {{$company->city}}, {{$company->province}} <br>
          Contact no: {{$company->contact_no}} <br>
          VAT Registered TIN: {{$company->companyTIN}} <br>
        </div>
        <div class="row">
          <div class="col-md-6">
            <b><u><h3>Official Receipt</h3></u></b>
          </div>
          <div class="col-md-6" style="text-align: right">
            <b><u><h4>NO. {{$payment_no}}</h4></u></b>
            Date: {{$cust_payment->created_at}}
          </div>
        </div>
        <div class="row" style="font-family:Arial, Helvetica, sans-serif; font-size: 18px;">
          RECEIVED from ____________________________________________ with TIn ___________
          and address at _______________________________________________________ engaged in the business style of __________________________________ the sum of ________________________Pesos ___________________
          in partial/full payment of __________________________________________________
        </div>
        <div class="row" style="margin-top: 30px;">
          <div style="float: left; width: 40%;">
            <b>Date Issued:</b> {{$now}} <br>
            <b>Valid From:</b> {{$now}}<br>
            <b>Valid Until:</b>
          </div>
          <div style="float: right; text-align: left">
            <b>Software Provider's Name:</b> Earl Dixon Geraldez<br>
            <b>Software Provider's Address:</b> ftygvubhkjnlmjkhg <br>
            <b>Software and System Version:</b> Version 1.0.1
          </div>
        </div>
      </div>
    </div>
</div> 
@endsection

