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
            <div class="form-group">
              <label class="col-sm-4 control-label">Status</label>
              <div class="col-sm-8">
                <p>{{$order->salesStatus}}</p>
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
              @foreach($order_products as $key => $product)
                <tr>
                  <td class="quantity">{{$product->quantity}}</td>
                  <td>{{$product->size}}</td>
                  <td style="width:1%;white-space:nowrap;vertical-align: middle">
                    {{$product->description}}
                  </td>
                  <td class="unit_price" style="width:1%;white-space:nowrap;vertical-align: middle; text-align: right">{{$product->total_price}}</td>
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
                <a type="button" class="btn btn-success btn-block" href="{{ url('./orders')}}/{{$order->id}}/edit"><i class="fa fa-edit"></i> Create Job Order</a>
                <a type="button" class="btn btn-success btn-block" href="{{ url('./orders')}}/{{$order->id}}/delete"><i class="fa fa-trash-o"></i> Void</a>
                @if($order->salesStatus == "Delivered")
                  <!-- <a type="button" class="btn btn-success btn-block" href="{{ url('/export_invoice')}}/{{$order->id}}"> Print Invoice</a> -->
                  <a type="button" class="btn btn-success btn-block" onclick="invoice('{{$order->id}}')"> Invoice</a>
                
                  <a type="button" class="btn btn-success btn-block" href="/SalesOrder/delivery/print/{{$order->id}}">Print Delivery Receipt</a>
                @elseif($order->salesStatus == "Invoiced")
                  <a type="button" class="btn btn-success btn-block" href="/SalesOrder/delivery/print/{{$order->id}}">Print Delivery Receipt</a>
                  <a type="button" class="btn btn-success btn-block" href="{{ url('/export_invoice')}}/{{$order->id}}"> Print Invoice</a>
                @elseif($order->salesStatus == "Paid")
                 <a type="button" class="btn btn-success btn-block" href="/SalesOrder/delivery/print/{{$order->id}}">Print Delivery Receipt</a>
                 <a type="button" class="btn btn-success btn-block" href="{{ url('/export_invoice')}}/{{$order->id}}"> Print Invoice</a>
                <a type="button" class="btn btn-success btn-block" href="/SalesOrder/payment/printOR/{{$payment_no}}"> Print O.R.</a>
                @else
                  <button type="button" class="btn btn-success btn-block" onclick="show_delivery_modal()"> Deliver</button>
                @endif
                
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
<input type="hidden" id="salesID" value="{{$order->id}}">
<!-- main modal -->
<div class="modal fade" id="deliver" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="deliver-modal-body">

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="invoice" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Invoice</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="invoice-modal-body">
         <div class="alert-danger" style="display:none"></div>
        <div class="row">
          <div class="col-md-4">Invoice No:</div>
          <div class="col-md-8">
            <input type="text" id="invoiceID" class="form-control" disabled style="margin-bottom: 10px;">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Delivery ID:</div>
          <div class="col-md-8">
            <input type="text" id="deliveryID" class="form-control" disabled style="margin-bottom: 10px;">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Sales ID:</div>
          <div class="col-md-8">
            <input type="text" class="form-control" id="salesID" disabled value="{{$order->id}}" style="margin-bottom: 10px;">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Invoice Amount:</div>
          <div class="col-md-8">
            <input type="number" class="form-control" id="invoiceAmount" name="" style="margin-bottom: 10px;" disabled>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Payment Due:</div>
          <div class="col-md-8">
            <input type="date" class="form-control" id="paymentdue" name="deliveryDate" required>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="save_invoice()">Save Invoice</button>
        <button class="btn btn-warning" type="button" data-dismiss="modal">
          <span class="glyphicon glyphicon-remove"></span> Close
        </button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('extra_scripts')
<script src="{{ asset("dist/js/order-show.js")}}"></script>
<script type="text/javascript">
  var global_invoiceID;
  function show_delivery_modal()
  {
    $.ajaxSetup({
     headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }); 
    $.ajax({
      type : 'get',
      url : '/SalesOrder/delivery/new',
      data : {},
      success : function(data){
        $('#deliver-modal-body').html(data);
        $('#deliver').modal('show');
        $('.form-horizontal').show();
        $('.modal-title').text('Deliver');
      }
    });
  }

  function deliver()
  {
    var deliveryID = $('#deliveryID').val();
    var salesID = $('#salesID').val();
    var delivery_mode = $('#deliveryMode').val();
    var delivery_address = $('#deliveryAddress').val();

    $.ajax({
      type : 'post',
      url : '/SalesOrder/delivery/save',
      data : {
        'deliveryID' : deliveryID,
        'salesID' : salesID,
        'delivery_mode' : delivery_mode,
        'delivery_address' : delivery_address
      },
      success : function(data){
        swal({
          title: "Success!",
          text: "Order has been delivered.",
          icon: "success",
          button: 'Ok',
        })
        .then((value) => {
          if (value) {
            $('#deliver').modal('hide');
            window.location.reload();
          } 
        });
      }
    });
  }

  function invoice(salesID)
  {
    $.ajax({
      type : 'get',
      url : '/SalesOrders/invoice',
      data : {
        'salesID' : salesID
      },
      success : function(data){
        console.log(data);
        $('#invoiceID').val(data[0]);
        global_invoiceID = data[0];
        $('#invoiceAmount').val(data[2]);
        $('#deliveryID').val(data[1]);
        $('#invoice').modal('show');
        $('.form-horizontal').show();
      }
    });
  }
  
  function save_invoice()
  {
    var invoice_amount = $('#invoiceAmount').val();
    var paymentdue = $('#paymentdue').val();
    var hasErrors = 0;
    if(invoice_amount == "")
    {
      hasErrors = 1;
      $('.alert-danger').text("Invoice amount is required.");
    }
    if(paymentdue == "")
    {
       hasErrors = 1;
       $('.alert-danger').text("Payment due is required.");
    }
    
    if(hasErrors == 1)
    {
      $('.alert-danger').show();
    }
    else
    {
      $.ajax({
        type : 'get',
        url : '/SalesOrders/invoice/save',
        data : {
          'invoiceID': $('#invoiceID').val(),
          'salesID' : $('#salesID').val(),
          'paymentdue' : $('#paymentdue').val(),
          'invoiceAmount' : $('#invoiceAmount').val()
        },
        success : function(data){
          if(data == 0)
          {
            swal({
              title: "Success!",
              text: "Order invoiced.",
              icon: "success",
              button: 'Ok',
            })
            .then((value) => {
              if (value) {
                window.location.reload();
              } 
            });
          }
        }
      });
    }
  }
</script>

@endpush