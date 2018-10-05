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
@if (session()->has('new_pattern'))
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
  <div class="col-lg-12">
    <div class="callout callout-warning" hidden>
      <h4> <i class="icon fa fa-warning"></i> Warning</h4>
      <p>This fabric cannot update price because the <b>latest effective date</b> is same as <b>today</b>.</p>
    </div>
  </div>    
  <div class="col-lg-6 col-md-6">
      <div class="box box-solid box-primary">
        <div class="box-header">
          <h3 class="box-title">Price History</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table id="data_table_prices" class="table table-bordered table-hover" width="100%"></table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!--/.col-->
  <div class="col-lg-6 col-md-6">
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">Update Price</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form" method="POST" action="{{ url('/fabric_prices') }}" onsubmit="return validate(this);">
      @CSRF
        <div class="box-body">
          <div class="row">
            <div class="col-sm-12">
              
              <input type="hidden" class="form-control" name="fabric_id" value="{{$fabric_id}}">
              <input type="hidden" class="form-control" id="latest_date" value="{{$latest_date}}">
              <div class="col-sm-12 form-group">
                <label class="control-label">Price Effective Date</label>
                <input id="display_date" type="text" class="form-control" readonly>
                <input id="date_effective" type="hidden" class="form-control" name="date_effective">  
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Unit Price</label>
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-7" style="padding-right:0">
                    <input id="unit_price_textbox" type="number" class="form-control" placeholder="Fabric unit price" name="unit_price" autocomplete="off" required min=1 max=1000>
                  </div>
                  <div class="col-xs-5 col-sm-5 col-md-4 no-padding">
                    <select id="dropdown" class="form-control" name="measurement_type">
                      <option value="0">per kgs</option>
                      <option value="1">per yards</option>
                    </select>
                  </div> 
                </div>
                <!-- /.row -->                             
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a type="button" class="btn btn-default" onclick="history.back(-1)">Cancel</a>
          <button id="btn_update_price" type="submit" class="btn btn-primary pull-right">Save</button>
        </div>
        <!-- /.box-footer -->
      </form>
      <!-- /.form end -->
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
  
  var current_date = get_full_date();

  $('#date_effective').val(current_date.numeric);
  $('#display_date').val(current_date.text);
  
  var latest_date = parse_date($('#latest_date').val());
  
  if(latest_date.numeric === current_date.numeric){
    $("#btn_update_price").attr('disabled','disabled');
    $("#display_date").attr('disabled','disabled');
    $("#unit_price_textbox").attr('disabled','disabled');
    $("#dropdown").attr('disabled','disabled');
    $(".callout").removeAttr('hidden');
  }


  /**
  * For Fabrics
  */
  var dataSet = [];

  @if(!empty($fabric_price))
    var dataSet = @json($fabric_price);
  @endif
  
  $('#data_table_prices').DataTable( {
      data: dataSet,
      columns: [
          { title: "Date Effective", data:"date_effective" }, 
          { 
            title: "Unit Price", data:"unit_price", 
            render: function(data){
              return '&#8369;'+data
            }
          }, 
          { 
            title: "Measurement Type", data:"measurement_type",
            render: function(data){
              if(data === 0){
                return "per kgs"
              }else{
                return "per yards"
              }
            }
          }
      ],
      "fnCreatedRow": function( nRow, aData, iDataIndex ) {
        $(nRow).attr('id', aData['id']);
      },
      "order": [[0,"desc"]]
  } );
} ); //end of document.ready

</script>
@endpush