@extends('layouts.main')

@push('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
@endpush

@section('page_header')
  @include('garments.header')
@endsection

@section('content')
@if (session()->has('new_type'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Adding Successful!</h4>
      New fabric type, {{ session()->get('new_type') }} has been added to the list.
    </div>
  </div>
</div>
@elseif(session()->has('edited_garment'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Editing Successful!</h4>
      Changes made for garment, {{ session()->get('edited_garment') }}.
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
@elseif (session()->has('new_fabric'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Adding Successful!</h4>
      New fabric, {{ session()->get('new_fabric') }} has been added to the list.
    </div>
  </div>
</div>
@elseif(session()->has('edited_fabric'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Editing Successful!</h4>
      Changes made for fabric, {{ session()->get('edited_fabric') }}.
    </div>
  </div>
</div>
@elseif (session()->has('deleted_fabric'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Delete Successful!</h4>
      Fabric, {{ session()->get('deleted_fabric') }} has been removed to the list.
    </div>
  </div>
</div>
@endif

<div class="row">
  <div class="col-lg-6 col-md-6">
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">Garment Types</h3>
        <div class="box-tools">
          <div class="input-group input-group-md" style="width: 150px;">
            <div class="input-group-btn">
              <a class="btn btn-flat btn-primary pull-right" href="./garment/create">
                <i class="fa fa-plus"> </i>  
                Add New Type
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <table id="data_table_types" class="table table-bordered table-hover" width="100%"></table>
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
              <a class="btn btn-flat btn-primary pull-right" href="./fabrics/create">
                <i class="fa fa-plus"> </i>  
                Add New Operation
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <table id="data_table_patterns" class="table table-bordered table-hover" width="100%"></table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!--/.col-->
</div>
<!-- /.row -->
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
        <table id="data_table_fabrics" class="table table-bordered table-hover" width="100%"></table>
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
  
  /**
  * For Types
  */
  var dataSet = [];

  @if(!empty($alsdjfasdf))
    var dataSet = @json($garment);
  @endif
  //console.log(dataSet); 
  
  $('#data_table_types').DataTable( {
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

  var source_ref_types = "{{ url('/garments') }}" + "/";
  
  $('#data_table_types').on('dblclick','td',function(e){
    window.location.href = source_ref_types + $(this).closest('tr').attr('id') + "/edit";
  });
  
  $('#data_table_types').on('click','button.btn_edit',function(e){
    window.location.href = source_ref_types + $(this).closest('tr').attr('id') + "/edit";
  });

  $('#data_table_types').on('click','button.btn_delete',function(e){
    if(confirm_delete(this))
      window.location.href = source_ref_types + $(this).closest('tr').attr('id') + "/delete";
  });

  /**
  * For Patterns
  */
  var dataSet = [];

  @if(session()->has('garment') && count($fabric) > 0)
    var dataSet = @json($fabric);
  @endif
  //console.log(dataSet); 
  
  $('#data_table_patterns').DataTable( {
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

  var source_ref_patterns = "{{ url('/fabrics') }}" + "/";
  
  $('#data_table_patterns').on('dblclick','td',function(e){
    window.location.href = source_ref_patterns + $(this).closest('tr').attr('id') + "/edit";
  });
  
  $('#data_table_patterns').on('click','button.btn_edit',function(e){
    window.location.href = source_ref_patterns + $(this).closest('tr').attr('id') + "/edit";
  });

  $('#data_table_patterns').on('click','button.btn_delete',function(e){
    if(confirm_delete(this))
      window.location.href = source_ref_patterns + $(this).closest('tr').attr('id') + "/delete";
  });

  /**
  * For Fabrics
  */
  var dataSet = [];

  @if(session()->has('garment') && count($fabric) > 0)
    var dataSet = @json($fabric);
  @endif
  //console.log(dataSet); 
  
  $('#data_table_fabrics').DataTable( {
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

  var source_ref_patterns = "{{ url('/fabrics') }}" + "/";
  
  $('#data_table_fabrics').on('dblclick','td',function(e){
    window.location.href = source_ref_patterns + $(this).closest('tr').attr('id') + "/edit";
  });
  
  $('#data_table_fabrics').on('click','button.btn_edit',function(e){
    window.location.href = source_ref_patterns + $(this).closest('tr').attr('id') + "/edit";
  });

  $('#data_table_fabrics').on('click','button.btn_delete',function(e){
    if(confirm_delete(this))
      window.location.href = source_ref_patterns + $(this).closest('tr').attr('id') + "/delete";
  });
  
} ); //end of document.ready

</script>
@endpush