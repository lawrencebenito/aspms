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
@endif

<div class="row">
  <div class="col-lg-12">
    <div class="box box-solid box-success">
      <div class="box-header">
        <h3 class="box-title">List of Clients</h3>
        <div class="box-tools">
          <div class="input-group input-group-md" style="width: 150px;">
            <div class="input-group-btn">
              <a class="btn btn-flat btn-success pull-right" href="./clients/create">
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
  
  @if(count($clients) > 0)
    var dataSet = @json($clients);
  @endif
  //console.log(dataSet);

  var option1 = "<button class='btn btn-xs row_view' data-toggle='tooltip' title='View'><i class='fa fa-eye'></i></button> ";
  var option2 = "<button class='btn btn-xs row_edit' data-toggle='tooltip' title='Edit'><i class='fa fa-edit'></i></button> ";

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
          defaultContent: option1+option2,
          sortable: false,
          "targets": -1
        }
      ]
  } );

  $('#data_table').on('dblclick','td',function(e){
    var id = $(this).parent().attr('id');
    //alert("double clicked!\n" + id);
    window.location.href = "{{ url('/clients') }}"+"\/"+id;
  });

  $('.row_view').click(function(e){
    var id = $(this).parent().parent().attr('id');
    //alert("button view clicked \n" + id);
    window.location.href = "{{ url('/clients') }}"+"\/"+id;
  });
  
  $('.row_edit').click(function(e){
    var id = $(this).parent().parent().attr('id');
    //alert("button view clicked \n" + id);
    window.location.href = "{{ url('/clients') }}"+"\/"+id+"/edit";
  });

} ); //end of document.ready

</script>
@endpush