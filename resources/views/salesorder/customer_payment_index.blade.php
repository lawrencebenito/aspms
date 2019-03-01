@extends('layouts.main')

@push('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
@endpush

@section('page_header')
  <i class="fa fa-shopping-cart"></i> Customer Payments
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Sales</a></li>
    <li class="active">Payments</li>
  </ol>
@endsection

@section('content')

<div class="row">
  <div class="table table-responsive sales-table col-md-11">
    <table class="table table-bordered" id="table">
      <tr bgcolor="yellow">
        <th width="150px">Sales No.</th>
        <th width="150px">Customer Account</th>
        <th>Customer Name</th>
        <th>Sales Status</th>
        <th>Payment Status</th>
        <th class="text-center" width="150px">
          <a class="create-modal btn btn-success btn-sm">
            <i class="glyphicon glyphicon-plus"></i>
          </a>
        </th>
      </tr>
      <tr>
      	<td></td>
      </tr>
     
    </table>
  </div>
</div>

@endsection