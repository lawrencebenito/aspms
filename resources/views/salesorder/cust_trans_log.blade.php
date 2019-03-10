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
<div class="container-fluid" style="margin-left: 50px; margin-right: 50px;">
  <div class="row">
    <center><h2><b>Statement of Account</b></h2></center>
  </div>
  <div class="row">
    <div class="col-md-6">
        <h3>To:</h3>
        <b>{{$client->company_name}}</b> <br>
        <b>{{$client->address_line}}, {{$client->address_municipality}}, {{$client->address_province}}</b> <br> <br>
        <b>Date: {{$now}}</b>
    </div>
    <div class="col-md-6" align="right">
      <div align="left">
        <h3>From:</h3>
        <b>{{$company->company_name}}</b> <br>
        <b>{{$company->company_address}}, {{$company->province}}, {{$company->city}}</b> <br>
        <b>Contact no: {{$company->contact_no}}</b> <br>
        <b>VAT Registered TIN: {{$company->companyTIN}}</b> <br> <br><br>
      </div>
    </div>
  </div>
  <div class="row">
    <table class="my-table" border="1">
      <thead style="background-color: yellow">
        <tr >
          <th style="border: 1px solid black;"><center>Date:</center></th>
          <th style="border: 1px solid black;"><center>Trans ID</center></th>
          <th style="border: 1px solid black;"><center>Description</center></th>
          <th style="border: 1px solid black;"><center>Amount</center></th>
          <th style="border: 1px solid black;"><center>Payment </center></th>
          <th style="border: 1px solid black;"><center>Remaining </center></th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
 </div> 
@endsection