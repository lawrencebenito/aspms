@extends('layouts.main')

@push('extra_links')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset("bower_components/select2/dist/css/select2.min.css")}}">
@endpush

@section('page_header')
  @include('designs.header')
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Maintenance</a></li>
    <li>Designs</li>
    <li class="active">Add Design</li>
  </ol>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Add New Design</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form" method="POST" action="{{ url('/designs') }}" onsubmit="return validate(this);">
        @CSRF
        <div class="box-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="col-sm-12 form-group">
                <label class="control-label">Type</label>
                <select id="type" class="form-control select2" style="width:100%" name="design_type" required></select>
                <input id="type_name" type="hidden" class="form-control" name="type_name">
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Supplier</label>
                <input type="text" class="form-control" placeholder="Supplier's name or company name" name="supplier" autocomplete="off" required>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Category Size</label>
                <select class="form-control" style="width:100%" name="category_size" required>
                  <option value="0">Small</option>
                  <option value="1">Medium</option>
                  <option value="3">Large</option>
                </select>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Size Range</label>
                <input type="text" class="form-control" placeholder="eg. 1x1 to 3x3 or 1 sq.in. - 4 sq.in. (Range base from pricing of supplier)" name="size_range" autocomplete="off" required>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Color Count</label>
                <input type="number" class="form-control" placeholder="Number of color for this design specification" name="color_count" autocomplete="off" required min=1 max=100>
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
                <label class="control-label">Unit Price</label>
                <input type="number" class="form-control" placeholder="Design unit price" name="unit_price" autocomplete="off" required min=1 max=1000>
              </div>
            </div>
            <!-- /.col-lg -->
          </div> 
          <!-- /.row inner -->   
        <div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a type="button" class="btn btn-default" href="{{url('/designs')}}">Cancel</a>
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

<script src="{{ asset("dist/js/designs-create.js")}}"></script>
@endpush