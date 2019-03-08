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
			<center>{{$fromDate}} - {{$toDate}}</center>
		</div>
		<br>
		<br>
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
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<div >
		<table class="my-table">
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
					$qtyTotal = 0;
				@endphp  
				@foreach($salesorders as $salesorder)
					@foreach($saleslines as $line)
						@if($line->salesID == $salesorder->salesID)
						@php
							$qtyTotal = $qtyTotal + $line->quantity;
						@endphp 
						<tr>
							<th style="border: 1px solid black;"><center>{{$salesorder->created_at}}</center></th>
							<th style="border: 1px solid black;"><center>{{$line->product_id}}</center></th>
							@foreach($products as $product)
								@if($product->id == $line->product_id)
									<th style="border: 1px solid black;"><center>{{$product->description}}</center></th>
									<th style="border: 1px solid black;"><center>{{$product->total_price}}</center></th>
								@endif
							@endforeach
							<th style="border: 1px solid black;"><center>{{$line->quantity}}</center></th>
							<th style="border: 1px solid black;"><center>{{$salesorder->salesID}}</center></th>
							@foreach($clients as $client)
								<th style="border: 1px solid black;"><center>{{$client->company_name}}</center></th>
						</tr>
							@endforeach
						@endif
					@endforeach
				@endforeach
				
				<tr>
					 <td style="border-top:1px solid black;"><b>Total:</b></td>
					 <td style="border-top:1px solid black;"></td>
					 <td style="border-top:1px solid black;"></td>
					 <td style="border-top:1px solid black;"></td>
					 <td style="border-top:1px solid black; text-align: right;padding: 5px;"><b>{{$qtyTotal}}</b></td>
					 <td style="border-top:1px solid black;"></td>
					 <td style="border-top:1px solid black;"></td>
				</tr>
			</tbody>
		</table>
	</div>

	<div style="float: right; border-top: 1px solid black; width: 200px; margin-top: 30px; text-align: center;">
		Authorized Signature
	</div>
</body>
</html>