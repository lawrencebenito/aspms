@extends('layouts.main')

@push('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
<style type="text/css">
	.noBorder {
		border: 0;
	}
</style>
@endpush

@section('page_header')
  <i class="fa fa-shopping-cart"></i> Quotation
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Sales</a></li>
    <li class="active">Quotation</li>
  </ol>
@endsection

@section('content')
<div class="container-fluid">
	<a href="/Quotation/exportPDF/{{$quotation->id}} " class="btn btn-primary">Export PDF</a>
	<div class="row">
		<div class="col-md-4" align="left">
			<h3><b>{{$company->company_name}}</b></h3>
			<br>
			{{$company->company_address}} <br>
			{{$company->city}}, {{$company->zipcode}} <br>
			Phone: {{$company->contact_no}} <br> <br>
			<h5><b>Quotation For:</b></h5>
			Name: <br>
			Company Name: {{$client->company_name}} <br>
			Street Address: {{$client->address_line}}<br>
			City, ST ZIP Code: {{$client->address_municipality}} <br>
			Phone: {{$client->contact_num}}
		</div>
		<div class="col-md-4">
			<h2><b>Quotation</b></h2><br>
			<b>Date:</b> {{$quotation->date_created}} <br>
			<b>Quotation ID:</b> {{$quotation->id}} <br>
			<b>Customer ID:</b> {{$quotation->client}} <br> <br>
			<i>Quotation valid until :</i> <br>
			<i>Prepared by:</i>
			
		</div>
	</div> <br> <br>
	<div class="row">
		<div class="col-md-8">
			<table style="table-layout: fixed; width: 100%; border-collapse: collapse;" border="1">
				<thead>
					<tr>
						<th>Item No.</th>
						<th>Description</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Amount</th>
					</tr>
				</thead>
				@php
					$totalAmount = 0;
				@endphp
				<tbody>
					@foreach($quotationlines as $line)
						
						@foreach($products as $product)
							@if($product->id == $line->product)
							<tr>
							<td>{{$line->product}}</td>
							<td>{{$product->description}}</td>
							<td></td>
							<td>{{$product->total_price}}</td>
							<td>{{$line->price}}</td>
							@php
								$totalAmount = $totalAmount + $line->price;
							@endphp
							</tr>
							@endif
						@endforeach
							
						
					@endforeach
					<tr class="noBorder">
						<td ></td>
						<td ></td>
						<td></td>
						<td>
							<b>Total:</b> <br>
							<b>Tax Rate:</b> <br>
							<b>Sales Tax:</b>
						</td>
						<td>
							<b>{{$totalAmount}}</b> <br>
							<b>0</b> <br>
							<b>0</b>
						</td>
					</tr>
				</tbody>
			</table>
			<br>
			<br>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8" align="right">
			<div style="border-top: 1px solid black; width: 200px; margin-top: 30px; text-align: center;">
			Authorized Signature 
			<br>
			<br>
			</div>
		</div>
		
	</div>
	</div>
	<div class="row">
		<div style=" text-align: right" class="col-md-8">
			<b>Software Provider's Name:</b> Earl Dixon Geraldez<br>
			<b>Software Provider's Address:</b> ftygvubhkjnlmjkhg <br>
			<b>Software and System Version:</b> Version 1.0.1
		</div>
	</div>
</div>

@endsection