<!DOCTYPE html>
<html>
<head>
	<title>Sales Report</title>
	<style type="text/css">
		.my-table {
		    word-wrap: break-word; 
		    table-layout:fixed;
		    width: 100%;
		    border-collapse: collapse;
		}

	</style>
</head>
<body style="font-family:Arial, Helvetica, sans-serif; font-size: 12px;">
	<div>
		<div>
			<center><h2 style="margin: 0px;"><b>{{$company->company_name}}</b></h2></center>
			<center>{{$company->company_address}}, {{$company->city}}, {{$company->province}}</center>
			<center>Contact no: {{$company->contact_no}}</center>
			<center>VAT Registered TIN: {{$company->companyTIN}}</center>
			<center><h2 style="margin: 0px;"><b>Sales Report</b></h2></center>
			<center> {{$fromDate}} -  {{$toDate}} </center>
		</div>
		<br>
		<br>
		<div >
		<div style="float: left; width: 40%;">
			<b>Date Issued:</b>  {{$now}}  <br>
			<b>Valid From:</b> {{$now}} <br>
			<b>Valid Until:</b>
		</div>
		<div style="float: right; text-align: left">
			<b>Software Provider's Name:</b> Earl Dixon Geraldez<br>
			<b>Software Provider's Address:</b> ftygvubhkjnlmjkhg <br>
			<b>Software and System Version:</b> Version 1.0.1
		</div>
	</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<div >
		<table class="my-table" border="1">
			<thead style="background-color: yellow">
				<tr >
					<th style="border: 1px solid black;"><center><b>Date</b></center></th>
					<th style="border: 1px solid black;"><center><b>Item No</b></center></th>
					<th style="border: 1px solid black;"><center><b>Item Description</b></center></th>
					<th style="border: 1px solid black;"><center><b>Price</b></center></th>
					<th style="border: 1px solid black;"><center><b>Quantity</b></center></th>
					<th style="border: 1px solid black;"><center><b>SO Reference</b></center></th>
					<th style="border: 1px solid black;"><center><b>Client</b></center></th>
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

	<div style="float: right; border-top: 1px solid black; width: 200px; margin-top: 30px; text-align: center;">
		Authorized Signature
	</div>
</body>
</html>