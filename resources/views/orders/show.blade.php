@extends('layouts.main')

@section('page_header')
  @include('orders.header')
@endsection

@section('content')

@if (session()->has('edited_order'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Editing Successful!</h4>
    Changes made for this order: {{ session()->get('edited_order') }}.
  </div>
@endif

<div class="row">
  <div class="col-md-9">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Viewing Order: {{$order->id}}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="form-group col-lg-6">
            <div class="form-group col-lg-12 no-padding">
              <label class="col-sm-4 control-label">Date Ordered</label>
              <div class="col-sm-8">
                <p>{{$order->date_ordered}}</p>
              </div>
            </div>
            <div class="form-group col-lg-12 no-padding">
              <label class="col-sm-4 control-label">Client Name</label>
              <div class="col-sm-8">
                <p>
                  {{$order->full_name}} 
                  @if (!is_null($order->company_name))
                  of {{$order->company_name}}
                  @endif
                </p>
              </div>
            </div>
            <div class="form-group col-lg-12 no-padding">
              <label class="col-sm-4 control-label">Company Address</label>
              <div class="col-sm-8">
                <p>{{$order->address}}</p>
              </div>
            </div>
            @if (!is_null($order->tin))
            <div class="form-group col-lg-12 no-padding">
              <label class="col-sm-4 control-label">Client Tin</label>
              <div class="col-sm-8">
                <p>{{$order->tin}}</p>
              </div>
              </div>  
            </div>
            @endif                            
          </div>
          <!-- End of First Column -->
          <!-- Start of Second Column -->
          <div class="form-group col-lg-6">
            <div class="form-group col-lg-12 no-padding">
              <label class="col-sm-4 control-label">PO Number</label>
              <div class="col-sm-8">
                <p>{{$order->po_number}}</p>
              </div>
            </div>
            <div class="form-group col-lg-12 no-padding">
              <label class="col-sm-4 control-label">Payment Terms</label>
              <div class="col-sm-8">
                <p>{{$order->payment_terms}}</p>
              </div>
            </div>              
            <div class="form-group">
              <label class="col-sm-4 control-label">Remarks</label>
              <div class="col-sm-8">
                <p>{{$order->remarks}}</p>
              </div>
            </div>              
          </div>
          <!-- End of Second Column -->
        </div>
        <div class="form-group">
          <div id="myTable" class="table-responsive">
            <table class="table table-bordered">
              <tr bgcolor="#f5f5f5">
                <th style="width: 15%">Quantity (pcs)</th>
                <th style="width: 12%">Size</th>
                <th style="width: 38%">Product Description</th>
                <th style="width: 15%">Unit Price</th>
                <th style="width: 15%">Price</th>
              </tr>
              @foreach($order_product as $key => $product)
                <tr>
                  <td class="quantity">{{$product->quantity}}</td>
                  <td>{{$product->size}}</td>
                  <td style="width:1%;white-space:nowrap;vertical-align: middle">
                    {{$product->description}}
                  </td>
                  <td class="unit_price" style="width:1%;white-space:nowrap;vertical-align: middle; text-align: right">{{$product->unit_price}}</td>
                  <td class="price" style="width:1%;white-space:nowrap;vertical-align: middle; text-align: right">0</td>
                <tr>
              @endforeach
            </table>
            <div class="form-group pull-right">
              <label for="total_price" class="col-sm-5 control-label">Total Price</label>
              <div class="col-sm-7 no-padding">
                <input type="text" class="form-control" name="total_price" id="total_price" readonly style="text-align: right" value="0">
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <a type="button" class="btn btn-default" href="{{url('/orders')}}">Back to List</a>
      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /.box box-primary -->
  </div>
  <!-- /.col -->
  <div class="col-md-3">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Options</h3>
        </div>
        <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-sm-12">
                <a type="button" class="btn btn-success btn-block" href="{{ url('./orders')}}/{{$order->id}}/edit"><i class="fa fa-edit"></i> Edit</a>
                <a type="button" class="btn btn-success btn-block" href="{{ url('./orders')}}/{{$order->id}}/delete"><i class="fa fa-trash-o"></i> Delete</a>
                <a type="button" class="btn btn-success btn-block">Print Invoice</a>
              </div>
              <!-- /.col -->
            </div> 
            <!-- /.row inner -->   
          <div>
          <!-- /.box-body -->
          <div class="box-footer"></div>
          <!-- /.box-footer -->
        </form>
        <!-- /.form-horizontal -->
      </div>
      <!-- /.box box-success -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection

@push('extra_scripts')
<script src="{{ asset("dist/js/order-show.js")}}"></script>
@endpush