@extends('layouts.main')

@push('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
@endpush

@section('page_header')
  Garments & Operations
@endsection

@section('content')
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
@endif

<div class="row">
  <div class="col-lg-6 col-md-6">
    <div class="box box-solid box-warning">
      <div class="box-header">
        <h3 class="box-title">List of Garments</h3>
        <div class="box-tools">
          <div class="input-group input-group-md" style="width: 150px;">
            <div class="input-group-btn">
              <a class="btn btn-flat btn-warning pull-right" href="./garments/create">
                <i class="fa fa-plus"> </i>  
                Add New Garment
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <table id="data_table_garment" class="table table-bordered table-hover" width="100%"></table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-lg-6 col-md-6">
    <div class="box box-solid box-warning">
      <div class="box-header">
        <h3 class="box-title">List of Operations</h3>
        <div class="box-tools">
          <div class="input-group input-group-md" style="width: 150px;">
            <div class="input-group-btn">
              <a class="btn btn-flat btn-warning pull-right" href="./operations/create">
                <i class="fa fa-plus"> </i>  
                Add New Operation
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <table id="data_table_operation" class="table table-bordered table-hover" width="100%"></table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
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
  * For garment
  */
  var dataSet = [];

  @if(count($garment) > 0)
    var dataSet = @json($garment);
  @endif
  //console.log(dataSet); 
  
  $('#data_table_garment').DataTable( {
      data: dataSet,
      columns: [
          { title: "Name", data:"name" }
      ],
      "fnCreatedRow": function( nRow, aData, iDataIndex ) {
        $(nRow).attr('id', aData['id']);
      }
  } );

  $('#data_table_garment').on('dblclick','tr',function(e){
    var id = $(this).attr('id');
    //alert("double clicked!\n" + id);
    window.location.href = "{{ url('/garments') }}"+"\/"+id+"/edit";
  });

  /**
  * For operation
  */
  var dataSet = [];

  @if(count($operation) > 0)
    var dataSet = @json($operation);
  @endif
  //console.log(dataSet);

  $('#data_table_operation').DataTable( {
      data: dataSet,
      columns: [
          { title: "Name", data:"name"}
      ],
      "fnCreatedRow": function( nRow, aData, iDataIndex ) {
        $(nRow).attr('id', aData['id']);
      }
  } );

  $('#data_table_operation').on('dblclick','tr',function(e){
    var id = $(this).attr('id');
    //alert("double clicked!\n" + id);
    window.location.href = "{{ url('/operations') }}"+"\/"+id+"/edit";
  });

} ); //end of document.ready

</script>
@endpush