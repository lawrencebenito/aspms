@extends('layouts.main')

@push('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
@endpush

@section('page_header')
  @include('fabrics.header')
@endsection

@section('content')

<!-- ALERT FOR FABRIC -->
@if (session()->has('new_fabric'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Adding Successful!</h4>
      New fabric pattern, {{ session()->get('new_fabric') }} has been added to the list.
    </div>
  </div>
</div>
@elseif (session()->has('deleted_fabric'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Delete Successful!</h4>
      Fabric has been removed to the list.
    </div>
  </div>
</div>

<!-- ALERT FOR TYPE -->
@elseif (session()->has('new_type'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Adding Successful!</h4>
      New fabric type, {{ session()->get('new_type') }} has been added to the list.
    </div>
  </div>
</div>
@elseif(session()->has('edited_type'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Editing Successful!</h4>
      Changes made for fabric type, {{ session()->get('edited_type') }}.
    </div>
  </div>
</div>
@elseif (session()->has('deleted_type'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Delete Successful!</h4>
      Fabric type, {{ session()->get('deleted_type') }} has been removed to the list.
    </div>
  </div>
</div>

<!-- ALERT FOR PATTERN -->
@elseif (session()->has('new_pattern'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Adding Successful!</h4>
      New fabric pattern, {{ session()->get('new_pattern') }} has been added to the list.
    </div>
  </div>
</div>
@elseif(session()->has('edited_pattern'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Editing Successful!</h4>
      Changes made for fabric pattern, {{ session()->get('edited_pattern') }}.
    </div>
  </div>
</div>
@elseif (session()->has('deleted_pattern'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Delete Successful!</h4>
      Fabric pattern, {{ session()->get('deleted_pattern') }} has been removed to the list.
    </div>
  </div>
</div>
@endif

<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">Fabric List</h3>
        <div class="box-tools">
          <div class="input-group input-group-md" style="width: 150px;">
            <div class="input-group-btn">
              <a class="btn btn-flat btn-primary pull-right" href="./fabrics/create">
                <i class="fa fa-plus"> </i>  
                Add New Fabric
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
<div class="row">
  <div class="col-lg-6 col-md-6">
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">Fabric Types</h3>
        <div class="box-tools">
          <div class="input-group input-group-md" style="width: 150px;">
            <div class="input-group-btn">
              <a class="btn btn-flat btn-primary pull-right" href="./fabric_types/create">
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
        <h3 class="box-title">Fabric Patterns</h3>
        <div class="box-tools">
          <div class="input-group input-group-md" style="width: 150px;">
            <div class="input-group-btn">
              <a class="btn btn-flat btn-primary pull-right" href="./fabric_patterns/create">
                <i class="fa fa-plus"> </i>  
                Add New Pattern
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
@endsection

@push('extra_scripts')
<!-- DataTables -->
<script src="{{ asset("bower_components/datatables.net/js/jquery.dataTables.min.js")}}"></script>
<script src="{{ asset("bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>

<script>

$(document).ready(function() {  
  
  /**
  * For Fabrics
  */
  var dataSet = [];

  @if(!empty($fabric))
    var dataSet = @json($fabric);
  @endif
  
  $('#data_table_fabrics').DataTable( {
      data: dataSet,
      columns: [
          { title: "Color", data:"color" }, 
          { title: "Pattern", data:"pattern_name" },
          { title: "Type", data:"type_name" },
          { title: "Supplier", data:"supplier_name" },
          { title: "Ref #", data:"reference_num" },
          { title: "GSM", data:"gsm" },
          { title: "Width", data:"width" },
          { title: " "}
      ],
      "fnCreatedRow": function( nRow, aData, iDataIndex ) {
        $(nRow).attr('id', aData['id']);
      },
      "order": [[2,"asc"]],
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

  var source_ref_fabrics = "{{ url('/fabrics') }}" + "/";
  
  $('#data_table_fabrics').on('dblclick','td',function(e){
    window.location.href = source_ref_fabrics + $(this).closest('tr').attr('id');
  });

  $('#data_table_fabrics').on('click','button.btn_view',function(e){
    window.location.href = source_ref_fabrics + $(this).closest('tr').attr('id');
  });
  
  $('#data_table_fabrics').on('click','button.btn_edit',function(e){
    window.location.href = source_ref_fabrics + $(this).closest('tr').attr('id') + "/edit";
  });

  $('#data_table_fabrics').on('click','button.btn_delete',function(e){
    if(confirm_delete(this))
      window.location.href = source_ref_fabrics + $(this).closest('tr').attr('id') + "/delete";
  });

  /**
  * For Types
  */
  var dataSet = [];

  @if(!empty($type))
    var dataSet = @json($type);
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

  var source_ref_types = "{{ url('/fabric_types') }}" + "/";
  
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

  @if(!empty($pattern))
    var dataSet = @json($pattern);
  @endif
  
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

  var source_ref_patterns = "{{ url('/fabric_patterns') }}" + "/";
  
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
  
} ); //end of document.ready

</script>
@endpush