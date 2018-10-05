@extends('layouts.main')

@push('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
@endpush

@section('page_header')
  @include('garments.header')
@endsection

@section('content')
<!-- ALERT FOR GARMENT -->
@if (session()->has('new_garment'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Adding Successful!</h4>
      New garment, {{ session()->get('new_garment') }} has been added to the list.
    </div>
  </div>
</div>
@elseif (session()->has('deleted_garment'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Delete Successful!</h4>
      Garment, {{ session()->get('deleted_garment') }} has been removed to the list.
    </div>
  </div>
</div>

<!-- ALERT FOR TYPE -->
@elseif (session()->has('new_segment'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Adding Successful!</h4>
      New segment, {{ session()->get('new_segment') }} has been added to the list.
    </div>
  </div>
</div>
@elseif(session()->has('edited_segment'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Editing Successful!</h4>
      Changes made for segment, {{ session()->get('edited_segment') }}.
    </div>
  </div>
</div>
@elseif (session()->has('deleted_segment'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Delete Successful!</h4>
      Segment, {{ session()->get('deleted_segment') }} has been removed to the list.
    </div>
  </div>
</div>

<!-- ALERT FOR OPERATIONS -->
@elseif (session()->has('new_operation'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Adding Successful!</h4>
      New operation, {{ session()->get('new_operation') }} has been added to the list.
    </div>
  </div>
</div>
@elseif(session()->has('edited_operation'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Editing Successful!</h4>
      Changes made for operation, {{ session()->get('edited_operation') }}.
    </div>
  </div>
</div>
@elseif (session()->has('deleted_operation'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Delete Successful!</h4>
      Operation, {{ session()->get('deleted_operation') }} has been removed to the list.
    </div>
  </div>
</div>
@endif

<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">Garment List</h3>
        <div class="box-tools">
          <div class="input-group input-group-md" style="width: 150px;">
            <div class="input-group-btn">
              <a class="btn btn-flat btn-primary pull-right" href="./garments/create">
                <i class="fa fa-plus"> </i>  
                Add New Garment
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <table id="data_table_garments" class="table table-bordered table-hover" width="100%"></table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-6 col-md-6">
      <div class="box box-solid box-primary">
        <div class="box-header">
          <h3 class="box-title">Garment Segments</h3>
          <div class="box-tools">
            <div class="input-group input-group-md" style="width: 150px;">
              <div class="input-group-btn">
                <a class="btn btn-flat btn-primary pull-right" href="./segments/create">
                  <i class="fa fa-plus"> </i>  
                  Add New Segment
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table id="data_table_segments" class="table table-bordered table-hover" width="100%"></table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-lg-6 col-md-6">
      <div class="box box-solid box-primary">
        <div class="box-header">
          <h3 class="box-title">Garment Operations</h3>
          <div class="box-tools">
            <div class="input-group input-group-md" style="width: 150px;">
              <div class="input-group-btn">
                <a class="btn btn-flat btn-primary pull-right" href="./operations/create">
                  <i class="fa fa-plus"> </i>
                  Add New Operation
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table id="data_table_operations" class="table table-bordered table-hover" width="100%"></table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!--/.col-->
  </div>
  <!-- /.row -->
@endsection

@push('extra_scripts')
<!-- DataTables -->
<script src="{{ asset("bower_components/datatables.net/js/jquery.dataTables.min.js")}}"></script>
<script src="{{ asset("bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>

<script>

$(document).ready(function() {  
  
  /**
  * For Garments
  */
  var dataSet = [];

  @if(!empty($garment))
    var dataSet = @json($garment);
  @endif
  
  $('#data_table_garments').DataTable( {
      data: dataSet,
      columns: [
          { title: "Name", data:"name" },
          { title: " "}
      ],
      "fnCreatedRow": function( nRow, aData, iDataIndex ) {
        $(nRow).attr('id', aData['id']);
      },
      "columnDefs": [
        {
          defaultContent: btn_view + btn_edit + btn_delete,
          className: "action-buttons",
          width: "50px",
          sortable: false,
          "targets": -1
        }
      ]
  } );

  var source_ref_garments = "{{ url('/garments') }}" + "/";
  
  $('#data_table_garments').on('dblclick','td',function(e){
    window.location.href = source_ref_garments + $(this).closest('tr').attr('id');
  });
  
  $('#data_table_garments').on('click','button.btn_view',function(e){
    window.location.href = source_ref_garments + $(this).closest('tr').attr('id');
  });

  $('#data_table_garments').on('click','button.btn_edit',function(e){
    window.location.href = source_ref_garments + $(this).closest('tr').attr('id') + "/edit";
  });

  $('#data_table_garments').on('click','button.btn_delete',function(e){
    if(confirm_delete(this))
      window.location.href = source_ref_garments + $(this).closest('tr').attr('id') + "/delete";
  });

  /**
  * For Segments
  */
  var dataSet = [];

  @if(!empty($segment))
    var dataSet = @json($segment);
  @endif
  
  $('#data_table_segments').DataTable( {
      data: dataSet,
      columns: [
          { title: "Name", data:"name" },
          { title: " "}
      ],
      "fnCreatedRow": function( nRow, aData, iDataIndex ) {
        $(nRow).attr('id', aData['id']);
      },
      "columnDefs": [
        {
          defaultContent: btn_edit + btn_delete,
          className: "action-buttons",
          width: "50px",
          sortable: false,
          "targets": -1
        }
      ]
  } );

  var source_ref_patterns = "{{ url('/segments') }}" + "/";
  
  $('#data_table_segments').on('dblclick','td',function(e){
    window.location.href = source_ref_patterns + $(this).closest('tr').attr('id') + "/edit";
  });
  
  $('#data_table_segments').on('click','button.btn_edit',function(e){
    window.location.href = source_ref_patterns + $(this).closest('tr').attr('id') + "/edit";
  });

  $('#data_table_segments').on('click','button.btn_delete',function(e){
    if(confirm_delete(this))
      window.location.href = source_ref_patterns + $(this).closest('tr').attr('id') + "/delete";
  });

  /**
  * For Operations
  */
  var dataSet = [];

  @if(!empty($operation))
    var dataSet = @json($operation);
  @endif
  
  $('#data_table_operations').DataTable( {
      data: dataSet,
      columns: [
          { title: "Name", data:"name" },
          { title: " "}
      ],
      "fnCreatedRow": function( nRow, aData, iDataIndex ) {
        $(nRow).attr('id', aData['id']);
      },
      "columnDefs": [
        {
          defaultContent: btn_edit + btn_delete,
          className: "action-buttons",
          width: "50px",
          sortable: false,
          "targets": -1
        }
      ]
  } );

  var source_ref_operations = "{{ url('/operations') }}" + "/";
  
  $('#data_table_operations').on('dblclick','td',function(e){
    window.location.href = source_ref_operations + $(this).closest('tr').attr('id') + "/edit";
  });
  
  $('#data_table_operations').on('click','button.btn_edit',function(e){
    window.location.href = source_ref_operations + $(this).closest('tr').attr('id') + "/edit";
  });

  $('#data_table_operations').on('click','button.btn_delete',function(e){
    if(confirm_delete(this))
      window.location.href = source_ref_operations + $(this).closest('tr').attr('id') + "/delete";
  });
  
} ); //end of document.ready

</script>
@endpush