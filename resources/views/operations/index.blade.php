@extends('layouts.main')

@section('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
@endsection

@section('page_header')
  <i class="ion ion-scissors"></i> Operations
@endsection

@section('content')

<div class="row">
  <div class="col-lg-6">
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
        <table id="data_table" class="table table-bordered table-hover" width="100%"></table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  @if (session()->has('new_operation'))
  <div class="col-lg-6">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Adding Successful!</h4>
      New operation, {{ session()->get('new_operation') }} has been added to the list.
    </div>
  </div>

  @elseif(session()->has('edited_operation'))
  <div class="col-lg-6">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Editing Successful!</h4>
      Changes made for operation, {{ session()->get('edited_operation') }}.
    </div>
  </div> 
  @endif
</div>
<!-- /.row -->
@endsection

@section('extra_scripts')
<!-- DataTables -->
<script src="{{ asset("bower_components/datatables.net/js/jquery.dataTables.min.js")}}"></script>
<script src="{{ asset("bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>

<script>

$(document).ready(function() {  
  var dataSet = [];

  @if(count($operation) > 0)
    var passedValue = {!! json_encode($operation->toArray()) !!};
    //console.log(passedValue);

    /**
    * This loop removes the keys on the array
    */
    for (var row in passedValue) {
      newrow = [];
      name = [];

      for (var cell in passedValue[row]){
        //console.log("key: " + cell + " | passedValue: " + passedValue[row][cell]);
        newrow.push(passedValue[row][cell]);
      }
      //console.log(newrow)
      dataSet.push(newrow);
    }
  @endif  
  
  $('#data_table').DataTable( {
      data: dataSet,
      columns: [
          { title: "ID" },
          { title: "Name" }
      ],
      "fnCreatedRow": function( nRow, aData, iDataIndex ) {
        $(nRow).attr('id', aData[0]);
      },
      "columnDefs": [
        {
          "targets": [0],
          "visible": false,
          "searchable": false
        }
      ]
  } );

  $('#data_table').on('dblclick','tr',function(e){
    var id = $(this).attr('id');
    //alert("double clicked!\n" + id);
    window.location.href = "{{ url('/operations') }}"+"\/"+id+"/edit";
  });

} ); //end of document.ready

</script>
@endsection