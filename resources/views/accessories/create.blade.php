@extends('layouts.main')

@push('extra_links')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset("bower_components/select2/dist/css/select2.min.css")}}">
@endpush

@section('page_header')
  @include('accessories.header')
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Maintenance</a></li>
    <li>Accessories</li>
    <li class="active">Add</li>
  </ol>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Add New Accessories</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form" method="POST" action="{{ url('/accessories') }}" onsubmit="return validate(this);">
        @CSRF
        <div class="box-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="col-sm-12 form-group">
                <label class="control-label">Type</label>
                <select id="type" class="form-control select2" style="width:100%" name="type" required></select>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Color</label>
                <input type="text" class="form-control" placeholder="Any descriptive color of the accessories" name="color" autocomplete="off" required>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Description</label>
                <input type="text" class="form-control" placeholder="(Optional) Description about this accessory" name="description" autocomplete="off">
              </div>              
              <div class="col-sm-12 form-group">
                <label class="control-label">Supplier</label>
                <input type="text" class="form-control" placeholder="Supplier's name or company name" name="supplier" autocomplete="off" required>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Reference Number</label>
                <input type="text" class="form-control" placeholder="(From supplier) item number or other reference number" name="reference_num" autocomplete="off" required>
              </div>
            </div>  
            <!-- /.col -->
            <div class="col-sm-6">
              <div class="col-sm-12 form-group">
                <label class="control-label">Price Effective Date</label>
                <input id="display_date" type="text" class="form-control" readonly>
                <input id="date_effective" type="hidden" class="form-control" name="date_effective">
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Price</label>
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-7" style="padding-right:0">
                    <input id="price" type="number" class="form-control" placeholder="Price of accessory upon buying" name="unit_price" autocomplete="off" required min=1s max=1000>
                  </div>
                  <div class="col-xs-5 col-sm-5 col-md-4 no-padding">
                    <select id="measurement_type" class="form-control" name="measurement_type">
                      <option value="0">per roll</option>
                      <option value="1">per gross</option>
                      <option value="2">per piece</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 form-group price_group">
                <label class="control-label">Quantity</label>
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-7" style="padding-right:0">
                    <input id="quantity" type="number" class="form-control" placeholder="Quantity of accessory" name="quantity" autocomplete="off" required min=1 max=1000>
                  </div>
                  <div class="col-xs-5 col-sm-5 col-md-4 no-padding">
                    <input id="display_quantity" type="text" class="form-control" readonly value="yards">
                  </div>
                </div>
              </div>
              <div class="col-sm-12 form-group price_group">
                <label class="control-label">Computed Unit Price</label>
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-7" style="padding-right:0">
                    <input id="unit_price" type="text" class="form-control" name="unit_prices" readonly>
                  </div>
                  <div class="col-xs-5 col-sm-5 col-md-4 no-padding">
                    <input id="display_unit_price" type="text" class="form-control" readonly value="per yard">
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col-lg -->
          </div> 
          <!-- /.row inner -->   
        <div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a type="button" class="btn btn-default" href="{{url('/accessories')}}">Cancel</a>
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

<script src="{{ asset("dist/js/accessories-create.js")}}"></script>
@endpush