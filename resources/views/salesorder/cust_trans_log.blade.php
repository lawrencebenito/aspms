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

  </style>
@endpush

@section('page_header')
  <i class="fa fa-shopping-cart"></i> Statement of Account
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Sales</a></li>
    <li class="active">Staement of Acccount</li>
  </ol>
@endsection

@section('content')
<div class="container-fluid" style="margin-left: 100px; margin-right: 100px;">
<a href="/Customer/SOA/{{$client->id}}" class="btn btn-primary">Export PDF</a>
  <div class="row">
    <center><h2><b>Statement of Account</b></h2></center>
  </div>
  <div class="row">
    <div class="col-md-6">
        <h4><b>To:</b></h4>
        <b>{{$client->company_name}}</b> <br>
        <b>{{$client->address_line}}, {{$client->address_municipality}}, {{$client->address_province}}</b> <br> <br>
        <b>Date: {{$now}}</b>
    </div>
    <div class="col-md-6" align="right">
      <div align="left">
        <h4><b>From:</b></h4>
        <b>{{$company->company_name}}</b> <br>
        <b>{{$company->company_address}}, {{$company->province}}, {{$company->city}}</b> <br>
        <b>Contact no: {{$company->contact_no}}</b> <br>
        <b>VAT Registered TIN: {{$company->companyTIN}}</b> <br> <br><br>
      </div>
    </div>
  </div>
  <div class="row">
    @php
      $totals = 0;
    @endphp
    <table class="my-table" border="1">
      <thead style="background-color: yellow">
        <tr >
          <th style="border: 1px solid black;"><center>Date:</center></th>
          <th style="border: 1px solid black;"><center>Trans ID</center></th>
          <th style="border: 1px solid black;"><center>Description</center></th>
          <th style="border: 1px solid black;"><center>Amount</center></th>
          <th style="border: 1px solid black;"><center>Payment </center></th>
          <th style="border: 1px solid black; margin-bottom: 30px;"><center>Remaining </center></th>
        </tr>
      </thead>
      <tbody>
        @foreach($transLog as $log)
          <tr>
            <td>{{$log->created_at}}</td>
            <td>{{$log->transID}}</td>
            <td>{{$log->description}}</td>
            <td align="right">{{$log->amount}}</td>
            <td align="right">{{$log->payment}}</td>
            <td align="right">{{$log->remaining}}</td>
            @php
              $totals = $totals + $log->remaining;
            @endphp
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td><b>Totals:</b></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td align="right"><b>{{$totals}}</b></td>
        </tr>
      </tfoot>
    </table>
  </div>
  <div class="row" style="margin-top: 30px;">
   <div class="col-md-6">
      <b>Comment:</b> ___________________________________<br>
      ___________________________________________________<br>
      ___________________________________________________<br> <br> 

   </div>
  </div>
  <div class="row" style="margin-bottom: 0px;">
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  </div>
  <div class="row" style="margin-top: 2px;">
    <center>Cut Here</center>
  </div>
  <div class="row" align="left">
    <div class="col-md-6">
      <h4><b>Remittance</b></h4>
      <u><b>{{$client->company_name}}</b></u> <br>
      <u><b>{{$client->address_line}}, {{$client->address_municipality}}, {{$client->address_province}}</b></u> <br> <br>
    </div>
    <div class="col-md-6" align="center">
      <h4><u><b>Customer: {{$client->company_name}}</b></u></h4>
      <center><b>Invoices Paid</b></center>
      @foreach($transLog as $log)
        @if($log->description == "Sales Invoice")
          <center><u>{{$log->transID}}</u></center> 
        @endif
      @endforeach
    </div>
    <h4 align="right"><b>Total Paid: {{$totals}}</b></h4> 
  </div>

 </div> 
@endsection