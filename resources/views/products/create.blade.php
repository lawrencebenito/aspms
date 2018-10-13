@extends('layouts.main')

@push('extra_links')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset("bower_components/select2/dist/css/select2.min.css")}}">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
@endpush

@section('page_header')
  <i class="ion ion-tshirt"></i> <span>Create Product</span>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="box box-success box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Product Header</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-sm-6">
            <div class="col-sm-12 form-group">
              <label>Date</label>
              <p id="date" style="padding-bottom:4px"></p>
              <input id="date_created" type="hidden" class="form-control" name="date_created" readonly>
            </div>
            <div class="col-sm-12 form-group">
              <label>Client Name</label>
              <select id="client" class="form-control select2" style="width: 100%;" name="client" required></select>
            </div>
            <div class="col-sm-12 form-group">
              <label>Product Description</label>
              <input type="text" class="form-control" placeholder="Any description for this product" name="description" autocomplete="off">
            </div>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <div class="col-sm-12 form-group">
              <label>Garment Type</label>
              <select id="garment" class="form-control select2" style="width: 100%;" name="client" required></select>
            </div>
            <div class="col-sm-12 form-group">
              <label>Size Range</label>
              <div class="row">
                <div class="form-group col-sm-5 no-margin">
                  <select id="min_range" class="form-control" style="width: 100%;" name="min_range" required>
                    <option value="1">XXS</option>
                    <option value="2" selected>XS</option>
                    <option value="3">S</option>
                    <option value="4">M</option>
                    <option value="5">L</option>
                    <option value="6">XL</option>
                    <option value="7">XXL</option>
                    <option value="8">XXXL</option>
                  </select>
                </div>
                <div class="form-group col-sm-2 no-margin" style="text-align:center">
                  <h5>to</h5>
                </div>
                <div class="form-group col-sm-5 no-margin">
                  <select id="max_range" class="form-control select2" style="width: 100%;" name="max_range" required>
                    <option value="1">XXS</option>
                    <option value="2">XS</option>
                    <option value="3">S</option>
                    <option value="4">M</option>
                    <option value="5">L</option>
                    <option value="6" selected>XL</option>
                    <option value="7">XXL</option>
                    <option value="8">XXXL</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-sm-12 form-group">
              <label>Consumption Size</label>
              <select id="consumption_size" class="form-control select2" style="width: 100%;" name="consumption_size" required>
                <option value="1">XXS</option>
                <option value="2">XS</option>
                <option value="3">S</option>
                <option value="4" selected>M</option>
                <option value="5">L</option>
                <option value="6">XL</option>
                <option value="7">XXL</option>
                <option value="8">XXXL</option>
              </select>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box box-success -->
  </div>
  <!-- /.col-->
</div>
<!-- /.row-->
<div class="modal fade" id="modal-fabrics">
  <div class="modal-dialog" style="width: 60%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Select a Fabric</h4>
      </div>
      <div class="modal-body table-responsive">
        <table id="data_table_fabrics" class="table table-bordered table-hover table-responsive" width="100%"></table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- FOR PRODUCT CONSUMPTION -->
<div class="row">
  <div class="col-lg-12">
    <div class="box box-success box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Fabric Consumption</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-sm-12 form-group">
            <div class="table-responsive">
              <table class="table table-bordered" style="white-space:nowrap; width:130%; max-width:130%;">
                <thead bgcolor="#f5f5f5">
                  <th> </th>
                  <th>Segment</th>
                  <th>Fabric</th>
                  <th> </th>
                  <th>Length(cm)</th>
                  <th>Width(cm)</th>
                  <th>Pair</th>
                  <th>Gsm</th>
                  <th>Required Qty Kgs /Pcs</th>
                  <th>Allowance(%)</th>
                  <th>Required Qty Kgs /Pcs (with allowance)</th>
                  <th style="background-color: #fffcd3">Required Qty Kgs /Dz</th>
                  <th>Fabric Width Inch</th>
                  <th style="background-color: #fffcd3">Require Qty Yds  /Dz</th>
                </thead>
                <tbody id="fabric_consumption">

                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="row">
          <div class="col-sm-4">
            <div class="col-sm-12 form-group">
              <label>Total Required Qty Kgs /Dz</label>
              <input id="garment" class="form-control" style="width: 100%;" name="client" value="0" readonly>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="col-sm-12 form-group">
              <label>Total Required Qty Yds /Dz</label>
              <input id="garment" class="form-control" style="width: 100%;" name="client" value="0" readonly>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="col-sm-12 form-group">
              <label>Total Fabric Cost</label>
              <input id="garment" class="form-control" style="width: 100%;" name="client" value="0" readonly>
            </div>
          </div>
        </div>        
      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /.box box-success -->
  </div>
  <!-- /.col-->
</div>
<!-- /.row-->

<!-- FOR ACCESSORIES COSTING -->
<div class="row">
  <div class="col-lg-12">
    <div class="box box-success box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Accessories Costing</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-sm-12 form-group">
            <div class="table-responsive">
              <table class="table table-bordered" style="white-space:nowrap; width:125%; max-width:125%;">
                <thead bgcolor="#f5f5f5">
                  <th>  </th>
                  <th>Segment</th>
                  <th>Fabric</th>
                  <th>Length(cm)</th>
                  <th>Width(cm)</th>
                  <th>Gsm</th>
                  <th>Required Qty Kgs /Pcs</th>
                  <th>Allowance</th>
                  <th>Required Qty Kgs /Pcs (with allowance)</th>
                  <th>Required Qty Kgs /Dz</th>
                  <th>Fabric Width Inch</th>
                  <th>Require Qty Yds  /Dz</th>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.box-body -->
      {{-- <div class="box-footer">
        <a type="button" class="btn btn-default" href="{{url('/products')}}">Cancel</a>
        <button type="submit" class="btn btn-success pull-right">Save</button>
      </div>
      <!-- /.box-footer --> --}}
    </div>
    <!-- /.box box-success -->
  </div>
  <!-- /.col-->
</div>
<!-- /.row-->

<!-- FOR DESIGN -->
<div class="row">
  <div class="col-lg-12">
    <div class="box box-success box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Design Costing</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-sm-12 form-group">
            <div class="table-responsive">
              <table class="table table-bordered" style="white-space:nowrap; width:125%; max-width:125%;">
                <thead bgcolor="#f5f5f5">
                  <th>Segment</th>
                  <th>Fabric</th>
                  <th>Length(cm)</th>
                  <th>Width(cm)</th>
                  <th>Gsm</th>
                  <th>Required Qty Kgs /Pcs</th>
                  <th>Allowance</th>
                  <th>Required Qty Kgs /Pcs (with allowance)</th>
                  <th>Required Qty Kgs /Dz</th>
                  <th>Fabric Width Inch</th>
                  <th>Require Qty Yds  /Dz</th>
                  <th> </th>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box box-success -->
  </div>
  <!-- /.col-->
</div>
<!-- /.row-->

<!-- FOR OPERATION COSTING -->
<div class="row">
  <div class="col-lg-12">
    <div class="box box-success box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Operation Costing</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-sm-12 form-group">
            <div class="table-responsive">
              <table class="table table-bordered" style="white-space:nowrap; width:125%; max-width:125%;">
                <thead bgcolor="#f5f5f5">
                  <th>Segment</th>
                  <th>Fabric</th>
                  <th>Length(cm)</th>
                  <th>Width(cm)</th>
                  <th>Gsm</th>
                  <th>Required Qty Kgs /Pcs</th>
                  <th>Allowance</th>
                  <th>Required Qty Kgs /Pcs (with allowance)</th>
                  <th>Required Qty Kgs /Dz</th>
                  <th>Fabric Width Inch</th>
                  <th>Require Qty Yds  /Dz</th>
                  <th> </th>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box box-success -->
  </div>
  <!-- /.col-->
</div>
<!-- /.row-->

<!-- FOR FINAL TOTAL -->
<div class="row">
  <div class="col-lg-12">
    <div class="box box-success box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Final FOB Cost</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-sm-6">
            <div class="col-sm-12 form-group">
              <label>Date</label>
              <p id="" style="padding-bottom:4px"></p>
              <input id="" type="hidden" class="form-control" name="date_created" readonly>
            </div>
            <div class="col-sm-12 form-group">
              <label>Client Name</label>
              <select id="" class="form-control select2" style="width: 100%;" name="client" required></select>
            </div>
            <div class="col-sm-12 form-group">
              <label>Product Description</label>
              <input type="" class="form-control" placeholder="Any description for this product" name="description" autocomplete="off" required>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <div class="col-sm-12 form-group">
              <label>Garment Type</label>
              <select id="" class="form-control select2" style="width: 100%;" name="client" required></select>
            </div>
            <div class="col-sm-12 form-group">
              <label>Size Range</label>
              <div class="row">
                <div class="form-group col-sm-5 no-margin">
                  <select id="" class="form-control" style="width: 100%;" name="min_range" required>
                    <option value="1">XXS</option>
                    <option value="2" selected>XS</option>
                    <option value="3">S</option>
                    <option value="4">M</option>
                    <option value="5">L</option>
                    <option value="6">XL</option>
                    <option value="7">XXL</option>
                    <option value="8">XXXL</option>
                  </select>
                </div>
                <div class="form-group col-sm-2 no-margin" style="text-align:center">
                  <h5>to</h5>
                </div>
                <div class="form-group col-sm-5 no-margin">
                  <select id="" class="form-control select2" style="width: 100%;" name="max_range" required>
                    <option value="1">XXS</option>
                    <option value="2">XS</option>
                    <option value="3">S</option>
                    <option value="4">M</option>
                    <option value="5">L</option>
                    <option value="6" selected>XL</option>
                    <option value="7">XXL</option>
                    <option value="8">XXXL</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-sm-12 form-group">
              <label>Consumption Size</label>
              <select id="consumption_size" class="form-control select2" style="width: 100%;" name="consumption_size" required>
                <option value="1">XXS</option>
                <option value="2">XS</option>
                <option value="3">S</option>
                <option value="4" selected>M</option>
                <option value="5">L</option>
                <option value="6">XL</option>
                <option value="7">XXL</option>
                <option value="8">XXXL</option>
              </select>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <a type="button" class="btn btn-default" href="{{url('/products')}}">Cancel</a>
        <button type="submit" class="btn btn-success pull-right">Save</button>
      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /.box box-success -->
  </div>
  <!-- /.col-->
</div>
<!-- /.row-->
@endsection

@push('extra_scripts')
<!-- Select2 -->
<script src="{{ asset("bower_components/select2/dist/js/select2.full.min.js")}}"></script>
<!-- DataTables -->
<script src="{{ asset("bower_components/datatables.net/js/jquery.dataTables.min.js")}}"></script>
<script src="{{ asset("bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>

<!-- Custom Scripts -->
<script src="{{ asset("dist/js/products-create.js")}}"></script>

{{-- <script>
var dataSet_fabrics = [];

@if(!empty($fabric))
  var dataSet_fabrics = @json($fabric);
@endif
</script> --}}
@endpush