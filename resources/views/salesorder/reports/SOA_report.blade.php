<!DOCTYPE html>
<html>
<head>
	<title>Statement of Account</title>
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
		<div style="margin-bottom: 20px;">
			<center><h2 style="margin: 0px;"><b>Statement of Account</b></h2></center>
			
		</div>
		<div style="text-align: justify; display: inline-block;">
			<div style="text-align: left; float: left; width: 80%;">
				<h3 style="margin: 0px;">To:</h3>
				{{$client->company_name}} <br>
				{{$client->address_line}}, {{$client->address_municipality}}, {{$client->address_province}} <br>
				 Date: {{$now}} <br>
			</div>
			<div style="text-align: left; display: inline-block; float: right">
				<h3 style="margin: 0px;">From:</h3>
				{{$company->company_name}}
				{{$company->company_address}}, {{$company->city}}, {{$company->province}} <br>
				Contact no: {{$company->contact_no}} <br>
				VAT Registered TIN: {{$company->companyTIN}}
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	@php
      $totals = 0;
    @endphp
	<div >
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
	  <div align="left">
	    <div style="float: left; display: inline-block;">
	      <h4><b>Remittance</b></h4>
	      <u><b>{{$client->company_name}}</b></u> <br>
	      <u><b>{{$client->address_line}}, {{$client->address_municipality}}, {{$client->address_province}}</b></u> <br> <br>
	    </div>
	    <div style="float: right; display: inline-block;">
	      <h4><u><b>Customer: {{$client->company_name}}</b></u></h4>
	      <b>Invoices Paid</b> <br>
	      
	      @foreach($transLog as $log)
	        @if($log->description == "Sales Invoice")
	        
	          <u>{{$log->transID}}</u> <br>
	        @endif
	      @endforeach
	    </div>
	</div>
	</div>
	<div style="margin-top:150px;">
		    <h4 align="right"><b>Total Paid: {{$totals}}</b></h4> 
		  </div>
</body>
</html>