@extends('layouts.main')

@push('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
@endpush

@section('page_header')
  @include('products.header')
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Sales</a></li>
    <li class="active">Products</li>
  </ol>
@endsection

@section('content')

@if (session()->has('new'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Adding Successful!</h4>
    New product has been added to the list.
  </div>
@endif

<div class="row">
  <div class="col-lg-12">
    <div class="box box-solid box-success">
      <div class="box-header">
        <h3 class="box-title">List of Products</h3>
        <div class="box-tools">
          <div class="input-group input-group-md" style="width: 150px;">
            <div class="input-group-btn">
              <a class="btn btn-flat btn-success pull-right" href="./products/create">
                <i class="fa fa-plus"> </i>  
                Create New Product
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
  /**
  * For Fabrics
  */
  var dataSet = [];

  @if(!empty($product))
    var dataSet = @json($product);
  @endif

  $('#data_table').DataTable( {
      data: dataSet,
      columns: [
          { title: "Style Number", data:"style_number" }, 
          { title: "Garment Type", data:"name" },
          { title: "Client Name", data:"client_name" },
          { 
            title: "Consumption Size", data:"consumption_size",
            render: function(data){
              if(data === 0){ return "Free Size" }
              else if(data === 1){ return "XXS" }
              else if(data === 2){ return "Extra Small" }
              else if(data === 3){ return "Small" }
              else if(data === 4){ return "Medium" }
              else if(data === 5){ return "Large" }
              else if(data === 6){ return "Extra Large" }
              else if(data === 7){ return "XXL" }
              else if(data === 8){ return "XXXL" }
              else{
                return "Error. Check index.blade.php"
              }
            }
          },
          { title: "Product Cost", data:"total_price", render: function(data){ return "Php " + data }},
          { title: " "}
      ],
      "fnCreatedRow": function( nRow, aData, iDataIndex ) {
        $(nRow).attr('id', aData['id']);
      },
      "order": [[1,"desc"]],
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

  var source_ref = "{{ url('/products') }}" + "/";
  
  $('#data_table').on('dblclick','td',function(e){
    window.location.href = source_ref + $(this).closest('tr').attr('id');
  });

  $('#data_table').on('click','button.btn_view',function(e){
    window.location.href = source_ref + $(this).closest('tr').attr('id');
  });
  
  $('#data_table').on('click','button.btn_edit',function(e){
    window.location.href = source_ref + $(this).closest('tr').attr('id') + "/edit";
  });

  $('#data_table').on('click','button.btn_delete',function(e){
    if(confirm_delete(this))
      window.location.href = source_ref + $(this).closest('tr').attr('id') + "/delete";
  });

} ); //end of document.ready

</script>
@endpush