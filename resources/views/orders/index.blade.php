@extends('layouts.main')

@push('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
@endpush

@section('page_header')
  @include('orders.header')
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Sales</a></li>
    <li class="active">Orders</li>
  </ol>
@endsection

@section('content')

@if (session()->has('new_order'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Adding Successful!</h4>
    New order has been added to the list.
  </div>
@endif

<div class="row">
  <div class="col-lg-12">
    <div class="box box-solid box-success">
      <div class="box-header">
        <h3 class="box-title">List of Orders</h3>
        <div class="box-tools">
          <div class="input-group input-group-md" style="width: 150px;">
            <div class="input-group-btn">
              <a class="btn btn-flat btn-success pull-right" href="./redirect_to_quo">
                <i class="fa fa-plus"> </i>  
                Add New Order
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <table id="data_table" class="table table-bordered table-hover" data-toggle='tooltip' title='Double click the row to view.' width="100%"></table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
@endsection

@push('extra_scripts')
<!-- DataTables -->
<script src="{{ asset("bower_components/datatables.net/js/jquery.dataTables.min.js")}}"></script>
<script src="{{ asset("bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>

<script>

$(document).ready(function() {
  var dataSet = [];
  
  @if(count($orders) > 0)
    var dataSet = @json($orders);
  @endif
  //console.log(dataSet);

  $('#data_table').DataTable( {
      data: dataSet,
      columns: [
          { title: "Order #", data:"id"},
          { title: "Date Ordered", data:"date_ordered"},
          { title: "Client Name", data:"full_name"},
          { title: "Company Name", data:"company_name"},
          { title: "Total Price", data:"total_price", render: $.fn.dataTable.render.number(',', '.', 0, '')},
          { title: " "}
      ],
      "fnCreatedRow": function( nRow, aData, iDataIndex ) {
        $(nRow).attr('id', aData['id']);
      },
      "columnDefs": [
        {
          defaultContent: "N/A",
          "targets": 3
        },
        {

          defaultContent: btn_view,
          sortable: false,
          "targets": -1
        }
      ]
  } );

  //TODO: Look for a way to stop warping reponsive table of bootstrap, how to make it one liner.
  var source_ref = "{{ url('/orders') }}" + "/";
  
  $('#data_table').on('dblclick','td',function(e){
    window.location.href = source_ref + $(this).closest('tr').attr('id');
  });

  $('.btn_view').click(function(e){
    window.location.href = source_ref + $(this).closest('tr').attr('id');
  });
  
  $('.btn_edit').click(function(e){
    window.location.href = source_ref + $(this).closest('tr').attr('id') + "/edit";
  });

} ); //end of document.ready

</script>
@endpush