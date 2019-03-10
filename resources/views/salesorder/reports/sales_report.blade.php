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
  <i class="fa fa-shopping-cart"></i> Sales Report
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Sales</a></li>
    <li class="active">Sales Report</li>
  </ol>
@endsection

@section('content')
	<div class="container-fluid">
		<a href='/SalesReport/export' class="btn btn-primary">Export PDF</a>
		<div class="row">
			<div>
				<center><h2 style="margin: 0px;"><b>{{$company->company_name}}</b></h2></center>
				<center>{{$company->company_address}}, {{$company->city}}, {{$company->province}}</center>
				<center>Contact no: {{$company->contact_no}}</center>
				<center>VAT Registered TIN: {{$company->companyTIN}}</center>
				<center><h2 style="margin: 0px;"><b>Sales Report</b></h2></center>
				<center> {{$fromDate}} -  {{$toDate}} </center>
			</div>
		</div>	
		<div class="row" style="margin-top: 30px; margin-bottom: 50px;">
		    <div class="col-md-6" align="left">
		      <b>Date Issued:</b>  {{$now}}  <br>
			  <b>Valid From:</b> {{$now}} <br>
			  <b>Valid Until:</b>
		    </div>
		    <div class="col-md-6" align="right">
		        <b>Software Provider's Name:</b> Earl Dixon Geraldez<br>
				<b>Software Provider's Address:</b> ftygvubhkjnlmjkhg <br>
				<b>Software and System Version:</b> Version 1.0.1
		    </div>
		 </div>
		 <div class="row">
		 	<table class="my-table" border="1">
		      <thead style="background-color: yellow">
		        <tr >
		          <th style="border: 1px solid black;"><center>Date</center></th>
		          <th style="border: 1px solid black;"><center>Item No.</center></th>
		          <th style="border: 1px solid black;"><center>Item Description.</center></th>
		          <th style="border: 1px solid black;"><center>Price</center></th>
		          <th style="border: 1px solid black;"><center>Quantity</center></th>
		          <th style="border: 1px solid black;"><center>SO Reference</center></th>
		          <th style="border: 1px solid black;"><center>Client</center></th>
		        </tr>
		      </thead>
		      <tbody>
		      	@php
		      		$totalPrice = 0;
		      		$totalQty = 0;
		      	@endphp
		      	@foreach($sales_orders as $order)
		      		@foreach($order_lines as $line)
		      			@if($line->order == $order->id)
		      				@foreach($products as $product)
		      					@if($product->id == $line->product)
			      					@foreach($clients as $client)
			      						@if($client->id == $order->client)
					      					<tr>
								      			<td>{{$order->date_created}}</td>
								      			<td>{{$product->id}}</td>
								      			<td>{{$product->description}}</td>
								      			<td align="right">{{$product->total_price}}</td>
								      			<td align="right">{{$line->quantity}}</td>
								      			<td>{{$order->id}}</td>
								      			<td>{{$client->company_name}}</td>
								      		</tr>
								      		@php
								      			$totalPrice = $totalPrice + $product->total_price;
		      									$totalQty = $totalQty + $line->quantity;
								      		@endphp
						      			@endif
						      		@endforeach
						      	@endif
		      				@endforeach
		      			@endif
		      		@endforeach
		      	@endforeach
		      	<tr>
		      		<td><b>Total:</b></td>
		      		<td></td>
		      		<td></td>
		      		<td align="right"><b><u>{{$totalPrice}}</u></b></td>
		      		<td align="right"><b><u>{{$totalQty}}</u></b></td>
		      		<td></td>
		      		<td></td>
		      	</tr>
		      </tbody>
		    </table>  
		 </div>
	</div>
@endsection