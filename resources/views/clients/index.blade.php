@extends('layouts.main')

@push('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
@endpush

@section('page_header')
  @include('clients.header')
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Sales</a></li>
    <li class="active">Clients</li>
  </ol>
@endsection

@section('content')

@if (session()->has('new_client'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Adding Successful!</h4>
    New client, {{ session()->get('new_client') }} has been added to the list.
  </div>
@elseif (session()->has('deleted'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Delete Successful!</h4>
    Client, {{ session()->get('deleted') }} has been removed to the list.
  </div>
@endif

<div class="row">
  <div class="col-lg-12">
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">List of Clients</h3>
        <div class="box-tools">
          <div class="input-group input-group-md" style="width: 150px;">
            <div class="input-group-btn">
              <a class="btn btn-flat btn-primary pull-right" href="./clients/create">
                <i class="fa fa-plus"> </i>  
                Add New Client
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
  
  @if(!empty($client))
    var dataSet = @json($client);
  @endif
  //console.log(dataSet);

  $('#data_table').DataTable( {
      data: dataSet,
      columns: [
          { title: "Last Name", data:"last_name"},
          { title: "First Name", data:"first_name"},
          { title: "Company Name", data:"company_name"},
          { title: "Contact Number", data:"contact_num"},
          { title: "Email Address", data:"email_address"},
          { title: " "}
      ],
      "fnCreatedRow": function( nRow, aData, iDataIndex ) {
        $(nRow).attr('id', aData['id']);
      },
      "columnDefs": [
        {
          defaultContent: "N/A",
          "targets": 2
        },
        {
          defaultContent: btn_view + btn_edit + btn_delete,
          className: "action-buttons",
          sortable: false,
          "targets": -1
        }
      ]
  } );

  var source_ref = "{{ url('/clients') }}" + "/";
  
  $('#data_table').on('dblclick','td',function(e){
    window.location.href = source_ref + $(this).closest('tr').attr('id');
  });

  $('.btn_view').click(function(e){
    window.location.href = source_ref + $(this).closest('tr').attr('id');
  });
  
  $('.btn_edit').click(function(e){
    window.location.href = source_ref + $(this).closest('tr').attr('id') + "/edit";
  });

  $('.btn_delete').click(function(e){
    if(confirm_delete(this))
      window.location.href = source_ref + $(this).closest('tr').attr('id') + "/delete";
  });
  
});//end of document.ready
</script>
@endpush