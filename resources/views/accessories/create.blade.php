@extends('layouts.main')

@push('extra_links')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset("bower_components/select2/dist/css/select2.min.css")}}">
@endpush

@section('page_header')
  @include('fabrics.header')
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Maintenance</a></li>
    <li>Fabrics</li>
    <li class="active">Add Fabric</li>
  </ol>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Add New Fabric</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form" method="POST" action="{{ url('/fabrics') }}" onsubmit="return validate(this);">
        @CSRF
        <div class="box-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="col-sm-12 form-group">
                <label class="control-label">Color</label>
                <input type="text" class="form-control" placeholder="Any descriptive color of the fabric" name="color" autocomplete="off" required>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Pattern</label>
                <select id="pattern" class="form-control select2" style="width:100%"  name="pattern" required></select>
                <input id="pattern_name" type="hidden" class="form-control" name="pattern_name">
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Type</label>
                <select id="type" class="form-control select2" style="width:100%" name="type" required></select>
                <input id="type_name" type="hidden" class="form-control" name="type_name">
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Supplier</label>
                <input type="text" class="form-control" placeholder="Supplier's name or company name" name="supplier_name" autocomplete="off" required>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Reference Number</label>
                <input type="text" class="form-control" placeholder="(From supplier) swatch number or other reference number" name="reference_num" autocomplete="off" required>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <div class="col-sm-12 form-group">
                <label class="control-label">Fabrication</label>
                <input type="text" class="form-control" placeholder="Ex. 80% Cotton 10% Polyester" name="fabrication" autocomplete="off" required>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">GSM</label>
                <input type="number" class="form-control price" placeholder="Gram per square meter. Minimum of 100, Maximum of 500" name="gsm" required autocomplete="off" min=100 max=500>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Fabric Width Inch</label>
                <input type="number" class="form-control" placeholder="Fabric width inch upon fabric procurement" name="width" autocomplete="off" required min=22 max=120>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Price Effective Date</label>
                <input id="display_date" type="text" class="form-control" readonly>
                <input id="date_effective" type="hidden" class="form-control" name="date_effective">
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Unit Price</label>
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-7" style="padding-right:0">
                    <input type="number" class="form-control" placeholder="Fabric unit price" name="unit_price" autocomplete="off" required min=1s max=1000>
                  </div>
                  <div class="col-xs-5 col-sm-5 col-md-4 no-padding">
                    <select class="form-control" name="measurement_type">
                      <option value="0">per kgs</option>
                      <option value="1">per yards</option>
                    </select>
                  </div> 
                </div>
                <!-- /.row -->                             
              </div>
            </div>
            <!-- /.col-lg -->
          </div> 
          <!-- /.row inner -->   
        <div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a type="button" class="btn btn-default" href="{{url('/fabrics')}}">Cancel</a>
          <button type="submit" class="btn btn-primary pull-right">Submit</button>
        </div>
        <!-- /.box-footer -->
      </form>
      <!-- /.form-horizontal -->
    </div>
    <!-- /.box-primary -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
@endsection

@push('extra_scripts')
<!-- Select2 -->
<script src="{{ asset("bower_components/select2/dist/js/select2.full.min.js")}}"></script>

<script src="{{ asset("dist/js/fabrics-create.js")}}"></script>
@endpush