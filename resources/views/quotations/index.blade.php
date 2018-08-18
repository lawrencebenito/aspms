@extends('layouts.main')

@push('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
@endpush

@section('page_header')
  @include('quotations.header')
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Sales</a></li>
    <li class="active">Quotations</li>
  </ol>
@endsection

@section('content')

@if (session()->has('new_quotation'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Adding Successful!</h4>
    New quotation has been added to the list.
  </div>
@elseif (session()->has('new_order'))
  <div class="callout callout-warning">
    <h4><i class="icon fa fa-info"></i> Creating Order</h4>
    <p><b>Create</b> or <b>pick</b> a quotation from the list then <b>choose</b> the create order option.</p>  
  </div>
@endif

<div class="row">
  <div class="col-lg-12">
    <div class="box box-solid box-success">
      <div class="box-header">
        <h3 class="box-title">List of Quotations</h3>
        <div class="box-tools">
          <div class="input-group input-group-md" style="width: 150px;">
            <div class="input-group-btn">
              <a class="btn btn-flat btn-success pull-right" href="./quotations/create">
                <i class="fa fa-plus"> </i>  
                Create New Quotation
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
  
  @if(count($quotations) > 0)
    var dataSet = @json($quotations);
  @endif
  //console.log(dataSet);

  $('#data_table').DataTable( {
      data: dataSet,
      columns: [
          { title: "Last Name", data:"last_name"},
          { title: "First Name", data:"first_name"},
          { title: "Company Name", data:"company_name"},
          { title: "Date Created", data:"date_created"},
          { title: "Number of Products", data:"product_count"},
          { title: " "}
      ],
      "fnCreatedRow": function( nRow, aData, iDataIndex ) {
        $(nRow).attr('id', aData['id']);
      },
      "columnDefs": [
        {
          defaultContent: btn_view + btn_edit + btn_delete + btn_order,
          sortable: false,
          "targets": -1
        }
      ]
  } );

  var source_ref = "{{ url('/quotations') }}" + "/";
  
  $('#data_table').on('dblclick','td',function(e){
    window.location.href = source_ref + $(this).closest('tr').attr('id');
  });

  $('.btn_view').click(function(e){
    window.location.href = source_ref + $(this).closest('tr').attr('id');
  });
  
  $('.btn_edit').click(function(e){
    window.location.href = source_ref + $(this).closest('tr').attr('id') + "/edit";
  });

  $('.btn_order').click(function(e){
    window.location.href = source_ref + $(this).closest('tr').attr('id') + "/order";
  });

} ); //end of document.ready

</script>
@endpush