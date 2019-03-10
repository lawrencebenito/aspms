<!DOCTYPE html>
<html>
<head>
	<title>Sales Quotation</title>
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
		<div style="text-align: justify; display: inline-block;">
			<div style="text-align: left; float: left; width: 80%;">
				<h2 style="margin: 0px;">{{$company->company_name}}</h2> <br>
				{{$company->company_address}} <br>
				{{$company->city}}, {{$company->zipcode}} <br>
				Phone: {{$company->contact_no}}  <br> <br>

				<b><h3>Quotation For:</h3> </b> 
				<b>Name : </b> <br>
				<b>Company Name : {{$client->company_name}}</b> <br>
				<b>Street Address : {{$client->address_line}}</b> <br>
				<b>City, St. ZIP Code : {{$client->address_municipality}}</b> <br>
				<b>Phone : {{$client->contact_num}}</b> <br>
			</div>
			<div style="text-align: left; display: inline-block; float: right">
				
				<b><h2>Quotation</h2></b> <br>
				<b>Date:</b> {{$quotation->date_created}} <br>
				<b>Quotation ID:</b> {{$quotation->id}} <br>
				<b>Customer ID: {{$quotation->client}}</b> <br> 
				<br>
				<i>Quotation valid untill:</i> <br>
				<i>Prepared by:</i>
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br><br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<div >
		<table class="my-table" border="1">
			<thead>
				<tr >
					<th style="border: 1px solid black;"><center>Item No.</center></th>
					<th style="border: 1px solid black;"><center>Description.</center></th>
					<th style="border: 1px solid black;"><center>Quantity</center></th>
					<th style="border: 1px solid black;"><center>Unit Price</center></th>
					<th style="border: 1px solid black;"><center>Amount</center></th>
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
				
				<tr>
					 <td style="border-top:1px solid black;"><b>Total:</b></td>
					 <td style="border-top:1px solid black;"></td>
					 <td style="border-top:1px solid black; text-align: right;padding: 5px;"><b></b></td>
					 <td style="border-top:1px solid black; text-align: right;padding: 5px;">
						<b>Total:</b> <br>
						<b>Tax Rate:</b> <br>
						<b>Sales Tax:</b>
					</td style="border-top:1px solid black; text-align: right;padding: 5px;">
					<td>
						<b>{{$totalAmount}}</b> <br>
						<b>0</b> <br>
						<b>0</b>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div style="float: right; border-top: 1px solid black; width: 200px; margin-top: 30px; text-align: center;">
		Authorized Signature
	</div>
	<br><br>
	<div >
		<div style="float: right; text-align: left">
			<b>Software Provider's Name:</b> Earl Dixon Geraldez<br>
			<b>Software Provider's Address:</b> ftygvubhkjnlmjkhg <br>
			<b>Software and System Version:</b> Version 1.0.1
		</div>
	</div>
</body>
</html>