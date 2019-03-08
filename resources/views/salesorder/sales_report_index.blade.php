@extends('layouts.main')

@push('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
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
  <button class="btn btn-primary" onclick="print_salesReport()">Print Report</button>

   
</div>

<div id="sales_report" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content"> 
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myLargeModalLabel"><center><strong>Date Range</strong></center></h4>
      </div>
      <div class="modal-body">
      <form id="date-range-form" method="GET" action="{{ url('/SalesReport/print') }}">
        <div class="col-md-6">
          <div class="form-group">
            <label>Date From:</label>
            <input type="date" class="form-control" id="startFrom" name="startFrom" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Date To:</label>
            <input type="date" class="form-control" id="endTo" name="endTo" required>
          </div>
        </div>
        <br><br>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" onclick="submit()">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
       </form>
      </div>
    </div>
  </div> <!-- /.modal-dialog -->
</div> <!-- View Modal -->



@endsection

@push('extra_scripts')
  <script type="text/javascript">
    function print_salesReport()
    {
      $('#sales_report').modal('show');
    }

    $('.datepicker').datepicker();

    function submit()
    {
      var fromDate = $('#startFrom').val();
      var toDate = $('#endTo').val();

      if(toDate < fromDate)
      {
       alert("Invalid Date Parameters");
      }
      else
      {
       $('#sales_report').modal('hide');
      }
    }
  </script>
@endpush