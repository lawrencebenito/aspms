@extends('layouts.main')

@push('extra_links')
<!-- bootstrap datepicker -->
{{-- <link rel="stylesheet" href="{{ asset("bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")}}"> --}}

@endpush

@section('page_header')
  @include('orders.header')
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="box box-success add-form box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Log Purchase Order</h3>
      </div>
      <!-- form start -->
      <form class="form" method="POST" action="{{ url('/orders') }}" onsubmit="return validate(this);">
        @CSRF
        <div class="box-body">
          <div class="row">
            <div class="form-group col-lg-6">
              <div class="form-group col-lg-12 no-padding">
                <label class="col-sm-4 control-label">Date Ordered</label>
                <div class="col-sm-8">
                  <input type="date" name="date" class="form-control">
                </div>
              </div>
              <div class="form-group col-lg-12 no-padding">
                <label class="col-sm-4 control-label">Client Name</label>
                <div class="col-sm-8">
                  <p>{{$quotation->full_name}}</p>
                </div>
              </div>
              @if (!is_null($quotation->company_name))
              <div class="form-group col-lg-12 no-padding">
                <label class="col-sm-4 control-label">Company Name</label>
                <div class="col-sm-8">
                  <p>{{$quotation->company_name}}</p>
                </div>
              </div>
              @endif              
              <div class="form-group col-lg-12 no-padding">
                <label class="col-sm-4 control-label">Client Address</label>
                <div class="col-sm-8">
                  <p>{{$quotation->address}}</p>
                </div>
              </div>              
            </div>
            <!-- End of First Column -->
            <!-- Start of Second Column -->
            <div class="form-group col-lg-6">
              <div class="form-group col-lg-12 no-padding">
                <label class="col-sm-4 control-label">PO Number</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" placeholder="Enter P.O. Number from client" name="company_name" autocomplete="off"</input>
                </div>
              </div>
              <div class="form-group col-lg-12 no-padding">
                <label class="col-sm-4 control-label">Payment Terms</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" placeholder="Eg. 30 days, 50-50, Full payment, etc." name="company_name" autocomplete="off"</input>
                </div>
              </div>              
              <div class="form-group">
                <label class="col-sm-4 control-label">Remarks</label>
                <div class="col-sm-8">
                  <textarea rows="3" class="form-control" placeholder="Eg. Special Requests, Different Shipping Address or Delivery Conditions" name="address" maxlength="200" style="resize:none;"></textarea>
                </div>
              </div>              
            </div>
            <!-- End of Second Column -->
          </div>
          <div class="form-group">
            <div id="myTable" class="table-responsive">
              <table class="table table-bordered">
                <tr bgcolor="#f5f5f5">
                  <th style="width: 7%"></th>
                  <th style="width: 15%">Quantity (pcs)</th>
                  <th style="width: 12%">Size</th>
                  <th style="width: 38%">Product Description</th>
                  <th style="width: 15%">Unit Price</th>
                  <th style="width: 15%">Price</th>
                </tr>
                @foreach($products as $key => $product)
                  <tr>
                    <td><input class="btn btn-success btn-xs row_add" type="button" value="+" data-toggle="tooltip" title="Add row"></td>
                    <td><input type="number" class="form-control quantity" placeholder="Enter quantity" name="quantities[]" 
                          required min=1 max="100000"  onKeyPress="if(this.value.length==6) return false;"></td>
                    <td>
                      <select class="form-control" name="sizes[]" placeholder="Pick size" required>
                        <option></option>
                        <option value="FS">Free Size</option>
                        <option value="XS">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>
                        <option value="XXXL">XXXL</option>
                      </select>
                    </td>
                    <td style="width:1%;white-space:nowrap;vertical-align: middle">
                      <input type="hidden" name="product[]" value="{{$product->id}}">  
                      <b>{{$product->garment}}</b> ({{$product->fabric}}) <i>{{$product->description}}</i>
                    </td>
                    <td class="unit_price" style="width:1%;white-space:nowrap;vertical-align: middle; text-align: right">{{$product->unit_price}}</td>
                    <td class="price" style="width:1%;white-space:nowrap;vertical-align: middle; text-align: right">0</td>
                  <tr>
                @endforeach
              </table>
              <div class="form-group pull-right">
                <label for="total_price" class="col-sm-5 control-label">Total Price</label>
                <div class="col-sm-7 no-padding">
                  <input type="text" class="form-control" id="total_price" readonly style="text-align: right" value="0">
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a type="button" class="btn btn-default" onclick="history.back(-1)">Back</a>
          <button type="submit" class="btn btn-success pull-right">Save</button>
        </div>
        <!-- /.box-footer -->
      </form>
      <!-- /.add-form -->
    </div>
    <!-- /.box box-primary -->
  </div>
  <!-- /.col-->
</div>
<!-- /.row-->
@endsection

@push('extra_scripts')
<!-- bootstrap datepicker -->
{{-- <script src="{{ asset("bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}"></script> --}}

<script src="{{ asset("dist/js/order-create.js")}}"></script>
@endpush