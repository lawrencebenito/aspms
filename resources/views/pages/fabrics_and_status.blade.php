@extends('layouts.main')

@push('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
@endpush

@section('page_header')
Fabrics & Status
@endsection

@section('content')
@if (session()->has('new_fabric'))
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
@elseif (session()->has('new_status'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Adding Successful!</h4>
      New status, {{ session()->get('new_status') }} has been added to the list.
    </div>
  </div>
</div>
@elseif(session()->has('edited_status'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Editing Successful!</h4>
      Changes made for status, {{ session()->get('edited_status') }}.
    </div>
  </div>
</div>
@endif

<div class="row">
  <div class="col-lg-6 col-md-6">
    <div class="box box-solid box-info">
      <div class="box-header">
        <h3 class="box-title">List of Fabrics</h3>
        <div class="box-tools">
          <div class="input-group input-group-md" style="width: 150px;">
            <div class="input-group-btn">
              <a class="btn btn-flat btn-info pull-right" href="./fabrics/create">
                <i class="fa fa-plus"> </i>  
                Add New Fabric
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <table id="data_table_fabric" class="table table-bordered table-hover" width="100%"></table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-lg-6 col-md-6">
    <div class="box box-solid box-info">
      <div class="box-header">
        <h3 class="box-title">List of Status</h3>
        <div class="box-tools">
          <div class="input-group input-group-md" style="width: 150px;">
            <div class="input-group-btn">
              <a class="btn btn-flat btn-info pull-right" href="./status/create">
                <i class="fa fa-plus"> </i>  
                Add New Status
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <table id="data_table_status" class="table table-bordered table-hover" width="100%"></table>
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
  * For fabric
  */
  var dataSet = [];

  @if(count($fabric) > 0)
    var dataSet = @json($fabric);
  @endif
  //console.log(dataSet);
  
  $('#data_table_fabric').DataTable( {
      data: dataSet,
      columns: [
          { title: "Name", data:"name"}
      ],
      "fnCreatedRow": function( nRow, aData, iDataIndex ) {
        $(nRow).attr('id', aData['id']);
      }
  } );

  $('#data_table_fabric').on('dblclick','tr',function(e){
    var id = $(this).attr('id');
    //alert("double clicked!\n" + id);
    window.location.href = "{{ url('/fabrics') }}"+"\/"+id+"/edit";
  });

  /**
  * For status
  */
  var dataSet = [];

  @if(count($status) > 0)
    var dataSet = @json($status);
  @endif
  //console.log(dataSet);

  $('#data_table_status').DataTable( {
      data: dataSet,
      columns: [
          { title: "Name", data: "description" }
      ],
      "fnCreatedRow": function( nRow, aData, iDataIndex ) {
        $(nRow).attr('id', aData['id']);
      }
  } );

  $('#data_table_status').on('dblclick','tr',function(e){
    var id = $(this).attr('id');
    //alert("double clicked!\n" + id);
    window.location.href = "{{ url('/status') }}"+"\/"+id+"/edit";
  });

} ); //end of document.ready

</script>
@endpush