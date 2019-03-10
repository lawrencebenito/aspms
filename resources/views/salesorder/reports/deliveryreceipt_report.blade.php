<!DOCTYPE html>
<html>
<head>
	<title>Delivery Receipt</title>
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
			<center><h2 style="margin: 0px;"><b>Delivery Receipt</b></h2></center>
		</div>
		<div style="text-align: justify; display: inline-block;">
			<div style="text-align: left; float: left; width: 80%;">
				<h3 style="margin: 0px;">Sender:</h3>
				{{$company->company_name}} <br>
				{{$company->company_address}}, {{$company->city}}, {{$company->province}} <br>
				Contact no: {{$company->contact_no}} <br> <br>
				<b>Buyer: </b> {{$client->company_name}} <br>
				<b>Delivery Address : </b> {{$delivery->delivery_address}}
			</div>
			<div style="text-align: left; display: inline-block; float: right">
				<h2><b>Delivery ID: {{$delivery->deliveryID}}</b></h2>
				<b>Mode of Delivery:</b> {{$delivery->delivery_mode}} <br>
				<b>Delivery Date:</b> {{$salesorder->updated_at}} <br>
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
	<div >
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

				@foreach($saleslines as $salesline)
					@foreach($products as $product)
						@if($product->id == $salesline->product)
							<tr>
								<td><center>{{$salesline->product}}</center></td>
								<td style="text-align: left; padding: 5px;">{{$product->description}}</td>
								<td style="text-align: right; padding: 5px;">{{$salesline->quantity}}</td>
								@php
					                $totalQty = $totalQty + $salesline->quantity;
					                $totalPrice = $totalPrice + $product->total_price * $salesline->quantity;
					             @endphp
								<td style="text-align: right; padding: 5px;">
									{{$product->total_price * $salesline->quantity}}
								</td>
								<td style="text-align: center;">{{$salesorder->id}}</td>
							</tr>
						@endif
					@endforeach
				@endforeach
				
				<tr>
					 <td style="border-top:1px solid black;"><b>Total:</b></td>
					 <td style="border-top:1px solid black;"></td>
					 <td style="border-top:1px solid black; text-align: right;padding: 5px;"><b>{{$totalQty}}</b></td>
					 <td style="border-top:1px solid black; text-align: right;"><b>{{$totalPrice}}</b></td>
					 <td style="border-top:1px solid black;"></td>
				</tr>
			</tbody>
		</table>
	</div>

	<div style="float: right; border-top: 1px solid black; width: 200px; margin-top: 30px; text-align: center;">
		Authorized Signature
	</div>
	<br><br>
	<div >
		<div style="float: left; width: 40%;">
			<b>Date Issued:</b> {{$validFrom}} <br>
			<b>Valid From:</b> {{$validFrom}}<br>
			<b>Valid Until:</b>
		</div>
		<div style="float: right; text-align: left">
			<b>Software Provider's Name:</b> Earl Dixon Geraldez<br>
			<b>Software Provider's Address:</b> ftygvubhkjnlmjkhg <br>
			<b>Software and System Version:</b> Version 1.0.1
		</div>
	</div>
</body>
</html>