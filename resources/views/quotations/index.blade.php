@extends('layouts.main')

@push('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
@endpush

@section('page_header')
  @include('quotations.header')
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Sales</a></li>
    <li class="active">Quotations</li>
  </ol>
@endsection

@section('content')

@if (session()->has('new_quotation'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Adding Successful!</h4>
    New quotation, {{ session()->get('new_quotation') }} has been added to the list.
  </div>
@endif

<div class="row">
  <div class="col-lg-12">
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">List of Quotations</h3>
        <div class="box-tools">
          <div class="input-group input-group-md" style="width: 150px;">
            <div class="input-group-btn">
              <a class="btn btn-flat btn-primary pull-right" href="./quotations/create">
                <i class="fa fa-plus"> </i>  
                Add New Quotation
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
  
  @if(count($quotations) > 0)
    var dataSet = @json($quotations);
  @endif
  //console.log(dataSet);

  var option1 = "<button class='btn btn-xs row_view' data-toggle='tooltip' title='View'><i class='fa fa-eye'></i></button> ";
  var option2 = "<button class='btn btn-xs row_edit' data-toggle='tooltip' title='Edit'><i class='fa fa-edit'></i></button> ";
  var option3 = "<button class='btn btn-xs row_delete' data-toggle='tooltip' title='Delete'><i class='fa fa-delete'></i></button> ";

  $('#data_table').DataTable( {
      data: dataSet,
      columns: [
          { title: "Last Name", data:"last_name"},
          { title: "First Name", data:"first_name"},
          { title: "Company Name", data:"company_name"},
          { title: "Date Created", data:"date_created"},
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
    window.location.href = "{{ url('/quotations') }}"+"\/"+id;
  });

  $('.row_view').click(function(e){
    var id = $(this).parent().parent().attr('id');
    //alert("button view clicked \n" + id);
    window.location.href = "{{ url('/quotations') }}"+"\/"+id;
  });
  
  $('.row_edit').click(function(e){
    var id = $(this).parent().parent().attr('id');
    //alert("button view clicked \n" + id);
    window.location.href = "{{ url('/quotations') }}"+"\/"+id+"/edit";
  });

} ); //end of document.ready

</script>
@endpush