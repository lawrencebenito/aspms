@extends('layouts.main')

@push('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
@endpush

@section('page_header')
  @include('designs.header')
@endsection

@section('content')

<!-- ALERT FOR DESIGN -->
@if (session()->has('new_design'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Adding Successful!</h4>
      New design has been added to the list.
    </div>
  </div>
</div>
@elseif (session()->has('deleted_design'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Delete Successful!</h4>
      Design has been removed to the list.
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
      New design type, {{ session()->get('new_type') }} has been added to the list.
    </div>
  </div>
</div>
@elseif(session()->has('edited_type'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Editing Successful!</h4>
      Changes made for design type, {{ session()->get('edited_type') }}.
    </div>
  </div>
</div>
@elseif (session()->has('deleted_type'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Delete Successful!</h4>
      Design type, {{ session()->get('deleted_type') }} has been removed to the list.
    </div>
  </div>
</div>
@endif

<div class="row">
  <div class="col-lg-8 col-md-8">
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">Design List</h3>
        <div class="box-tools">
          <div class="input-group input-group-md" style="width: 150px;">
            <div class="input-group-btn">
              <a class="btn btn-flat btn-primary pull-right" href="./designs/create">
                <i class="fa fa-plus"> </i>  
                Add New Design
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <table id="data_table_designs" class="table table-bordered table-hover" width="100%"></table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-lg-4 col-md-4">
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">Design Types</h3>
        <div class="box-tools">
          <div class="input-group input-group-md" style="width: 150px;">
            <div class="input-group-btn">
              <a class="btn btn-flat btn-primary pull-right" href="./design_types/create">
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
  * For Designs
  */
  var dataSet = [];

  @if(!empty($design))
    var dataSet = @json($design);
  @endif
  
  $('#data_table_designs').DataTable( {
      data: dataSet,
      columns: [
          { title: "Type", data:"type_name" }, 
          { title: "Supplier", data:"supplier" },
          { 
            title: "Size", data:"category_size",
            render: function(data){
              if(data === 0){
                return "Small"
              }else if(data === 1){
                return "Medium"
              }else if(data === 2){
                return "Large"
              }else{
                return "Error. Check index.blade.php"
              }
            }
          },
          { title: "Size Range", data:"size_range" },
          { title: "Color Count", data:"color_count" },
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

  var source_ref_designs = "{{ url('/designs') }}" + "/";
  
  $('#data_table_designs').on('dblclick','td',function(e){
    window.location.href = source_ref_designs + $(this).closest('tr').attr('id');
  });

  $('#data_table_designs').on('click','button.btn_view',function(e){
    window.location.href = source_ref_designs + $(this).closest('tr').attr('id');
  });
  
  $('#data_table_designs').on('click','button.btn_edit',function(e){
    window.location.href = source_ref_designs + $(this).closest('tr').attr('id') + "/edit";
  });

  $('#data_table_designs').on('click','button.btn_delete',function(e){
    if(confirm_delete(this))
      window.location.href = source_ref_designs + $(this).closest('tr').attr('id') + "/delete";
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

  var source_ref_types = "{{ url('/design_types') }}" + "/";
  
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
  
} ); //end of document.ready

</script>
@endpush