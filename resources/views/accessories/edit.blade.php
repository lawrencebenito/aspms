@extends('layouts.main')

@push('extra_links')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset("bower_components/select2/dist/css/select2.min.css")}}">
@endpush

@section('page_header')
  @include('acccessories.header')
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Maintenance</a></li>
    <li>Accessories</li>
    <li class="active">Edit</li>
  </ol>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Edit Fabric Information</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form" method="POST" action="{{ url('/fabrics') }}/{{$fabric->id}}" onsubmit="return validate(this);">
        @CSRF
        <div class="box-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="col-sm-12 form-group">
                <label class="control-label">Color</label>
                <input type="text" class="form-control" placeholder="Any descriptive color of the fabric" value="{{$fabric->color}}" name="color" autocomplete="off" required>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Pattern</label>
                <select id="pattern" class="form-control select2" style="width:100%" value="{{$fabric->pattern}}" name="pattern" required></select>
                <input id="pattern_name" type="hidden" class="form-control" value="{{$fabric->pattern_name}}" name="pattern_name">
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Type</label>
                <select id="type" class="form-control select2" style="width:100%" value="{{$fabric->type}}" name="type"  required></select>
                <input id="type_name" type="hidden" class="form-control" value="{{$fabric->type_name}}" name="type_name">
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Supplier</label>
                <input type="text" class="form-control" placeholder="Supplier's name or company name" value="{{$fabric->supplier_name}}" name="supplier_name" autocomplete="off" required>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Reference Number</label>
                <input type="text" class="form-control" placeholder="(From supplier) swatch number or other reference number" value="{{$fabric->reference_num}}" name="reference_num" autocomplete="off" required>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <div class="col-sm-12 form-group">
                <label class="control-label">Fabrication</label>
                <input type="text" class="form-control" placeholder="Ex. 80% Cotton 10% Polyester" value="{{$fabric->fabrication}}" name="fabrication" autocomplete="off" required>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">GSM</label>
                <input type="number" class="form-control price" placeholder="Gram per square meter. Minimum of 100, Maximum of 500" value="{{$fabric->gsm}}" name="gsm" required autocomplete="off" min=100 max=500>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Fabric Width Inch</label>
                <input type="number" class="form-control" placeholder="Fabric width inch upon fabric procurement" value="{{$fabric->width}}" name="width" autocomplete="off" required min=22 max=120>
              </div>
            </div>
            <!-- /.col-lg -->
          </div> 
          <!-- /.row inner -->   
        <div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a type="button" class="btn btn-default" onclick="history.back(-1)">Cancel</a>
          {{ method_field('PUT') }}
          <button type="submit" class="btn btn-primary pull-right">Save</button>
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

<script src="{{ asset("dist/js/fabrics-edit.js")}}"></script>
@endpush