@extends('layouts.main')

@push('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
@endpush

@section('page_header')
  @include('workers.header')
@endsection

@section('content')

@if (session()->has('new_worker'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Adding Successful!</h4>
    New employee, {{ session()->get('new_worker') }} has been added to the list.
  </div>
@endif

<div class="row">
  <div class="col-lg-12">
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">List of Workers</h3>
        <div class="box-tools">
          <div class="input-group input-group-md" style="width: 150px;">
            <div class="input-group-btn">
              <a class="btn btn-flat btn-primary pull-right" href="./workers/create">
                <i class="fa fa-plus"> </i>  
                Add New Worker
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <table id="data_table" class="table table-bordered table-hover" width="100%"></table>
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
  
  @if(count($worker) > 0)
    var dataSet = @json($worker);
  @endif
  //console.log(dataSet);
  
  $('#data_table').DataTable( {
      data: dataSet,
      columns: [
          { title: "Last Name", data:"last_name"},
          { title: "First Name", data:"first_name"},
          { title: "Contact Number", data:"contact_number"},
          { title: "Address", data:"address"}
      ],
      "fnCreatedRow": function( nRow, aData, iDataIndex ) {
        $(nRow).attr('id', aData['id']);
      }
  } );

  $('#data_table').on('dblclick','tr',function(e){
    var id = $(this).attr('id');
    //alert("double clicked!\n" + id);
    window.location.href = "{{ url('/workers') }}"+"\/"+id;
  });

} ); //end of document.ready

</script>
@endpush