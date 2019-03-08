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
  <i class="fa fa-shopping-cart"></i> Delivery
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Sales</a></li>
    <li class="active">Delivery</li>
  </ol>
@endsection

@section('content')
<div class="container-fluid" style="margin-left: 50px; margin-right: 50px;">
	<a href="/SalesOrder/delivery/export/{{$salesID}}" class="btn btn-primary">Export PDF</a>
  <div class="row">
    <div class="col-md-2">
      <img src="/uploads/{{$company->logo}}" alt="Smiley face" height="100%" width="100%">
    </div>
    <div class="col-md-8" align="center">
      <h3>{{$company->company_name}}</h3>
      {{$company->company_address}}, {{$company->city}}, {{$company->province}} <br>
      Contact no: {{$company->contact_no}} <br>
      VAT Registered TIN: {{$company->companyTIN}} <br>
      <h2>Delivery Receipt</h2>
    </div>
  </div>
  
  <div class="row" style="margin-top: 30px; margin-bottom: 50px;">
    <div class="col-md-6" align="left">
      <h4><b>Sender: </b></h4>
      {{$company->company_name}} <br>
      {{$company->company_address}}, {{$company->city}}, {{$company->province}} <br>
      Contact no: {{$company->contact_no}} <br> <br>
      <h4><b>Buyer: {{$client->company_name}}</b></h4>
      <b>Delivery Address:</b> {{$delivery->delivery_address}}
    </div>
    <div class="col-md-6" align="right">
      <h3><b>Delivery ID:</b> {{$delivery->deliveryID}}</h3>
      <b>Mode of Delivery:</b> {{$delivery->delivery_mode}} <br>
      <b>Delivery Date:</b> {{$delivery->created_at}}
    </div>
  </div>
  <div class="row">
    <table class="my-table" border="1">
      <thead style="background-color: yellow">
        <tr >
          <th style="border: 1px solid black;"><center>Item No.</center></th>
          <th style="border: 1px solid black;"><center>Item Description.</center></th>
          <th style="border: 1px solid black;"><center>Quantity</center></th>
          <th style="border: 1px solid black;"><center>Price</center></th>
          <th style="border: 1px solid black;"><center>SO Reference</center></th>
        </tr>
      </thead>
      <tbody>
        @php
          $totalQty = 0;
          $totalPrice = 0;
        @endphp
        @foreach($orderlines as $line)
          @foreach($products as $product)
            @if($product->id == $line->product)
            <tr>
              <td>{{$product->id}}</td>
              <td>{{$product->description}}</td>
              <td style="text-align: right">{{$line->quantity}}</td>
              @php
                $totalQty = $totalQty + $line->quantity;
                $totalPrice = $totalPrice + $product->total_price * $line->quantity;
              @endphp
              <td style="text-align: right">{{$product->total_price * $line->quantity}}</td>
              <td>{{$salesID}}</td>
            </tr>
            @endif
          @endforeach
        @endforeach
          <tr>
             <td style="border-top:1px solid black;"><b>Total:</b></td>
             <td style="border-top:1px solid black;"></td>
             <td style="border-top:1px solid black; text-align: right;padding: 5px;"><b>{{$totalQty}}</b></td>
             <td style="border-top:1px solid black; text-align: right"><b>{{$totalPrice}}</b></td>
             <td style="border-top:1px solid black;"></td>
          </tr>
      </tbody>
    </table>
  </div>
  <div class="row" align="right" style="margin-top: 70px;">
    <div style="width: 200px; text-align: center; border-top: solid 1px;">
      Authorized Signature
    </div>
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
@endsection  