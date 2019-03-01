<form class="form-horizontal" role="form" method="" id="salesline_form">
  {{csrf_field()}}
  <div class="form-group container-fluid actionpane" style="margin-left: 8px">
    @if($sales_order->salesStatus == "Open Order")
      <button type="button" class="btn btn-success" onclick="confirmSO('{{$sales_order->salesID}}')" id="confirmBtn"> Deliver</button>
    @endif
    @if($sales_order->salesStatus == "Delivered")
      <a class="btn btn-info" href='/SalesOrders/print/SOConfirmation/{{$sales_order->salesID}}'>Print Delivery Receipt</a>
      <button type="button" class="btn btn-info" onclick="invoiceSO('{{$sales_order->salesID}}')" id="invoiceBtn"> Invoice</button>
    @endif
    @if($sales_order->salesStatus == "Invoiced")
      <a class="btn btn-info" href='/SalesOrders/print/invoice/{{$sales_order->salesID}}'>Print Sales Invoice</a>
    @endif

  </div>
  <div class="form-group">
    <div class="panel-group" id="accordion">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h4><a href="#coll-header" data-toggle="collapse" >Sales Order Header</a></h4>
        </div>
        <div id="coll-header" class="panel-collapse collapse">
          <div class="panel-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <h5><b>Sales Order No:</b><br>{{$sales_order->salesID}}</h5>
                  </div>
                  <div class="form-group">
                    <h5><b>Requested Delivery Date:</b><br>{{$sales_order->requestedDeliveryDate}}</h5>
                  </div>
                  <div class="form-group">
                    <h5><b>Sales Status:</b><br>{{$sales_order->salesStatus}}</h5>
                  </div>
                  <div class="form-group">
                    <h5><b>Delivery Address:</b><br>{{$client->address_line}}, {{$client->address_municipality}}, {{$client->address_province}}</h5>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <h5><b>Customer Name:</b><br>{{$client->company_name}}</h5>
                  </div>
                  <div class="form-group">
                    <h5><b>Delivery Address:</b><br>{{$client->address_line}}, {{$client->address_municipality}}, {{$client->address_province}}</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @php
        $hasSalesLine = 0;
        $ctr = 0;
      @endphp
      <div class="panel panel-info">
        <div class="panel-heading">
          <h4><a href="#coll-deatils" data-toggle="collapse">Sales Order Lines</a></h4>
        </div>
        <div id="coll-deatils" class="panel-collapse collapse">
          <div class="panel-body">
            <div class="table table-responsive sales-table col-md-11">
              <button type="button" class="btn btn-warning" onclick="editSalesLines('{{$sales_order->salesID}}')" id="editBtn"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
              <div>
                <div class="alert alert-danger" style="display:none"></div>
              </div>
              <table class="table table-bordered">
                <thead>
                  <tr bgcolor="yellow" id="tableheader">
                    <th width="150px">Item No.</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Quantity</th>
                    <th>Net Amount</th>
                  </tr>
                </thead>
                <tbody id="salesline-table-body">
                  @foreach($saleslines as $salesline)
                    @foreach($products as $product)
                      @if($product->id == $salesline->product_id)
                        @break
                      @endif
                    @endforeach
                  @php
                    $hasSalesLines = 1;
                  @endphp
                  <tr id="row{{$ctr}}" class="linerow">
                    <td id="td{{$ctr}}" data-id="{{$salesline->product_id}}" data-recid="{{$salesline->recID}}" class="salesline-recid">{{$salesline->product_id}}</td>
                    <td id="productName{{$ctr}}" class="productName">{{$product->description}}</td>
                    <td id ="productPrice{{$ctr}}" class="productPrice">{{$product->total_price}}</td>
                    <td ><input type="number" class="form-control productQty" id="productQty{{$ctr}}" name="quantity" onchange="getNetAmount(this.value,'{{$ctr}}')" required placeholder="{{$salesline->quantity}}" disabled> </td>
                    <td id="productNetAmount{{$ctr}}" class="productNetAmount">{{$salesline->netAmount}}</td>
                  </tr>
                  @php
                    $ctr++;
                  @endphp
                  @endforeach
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>

    </div>
  </div>
  <div class="modal-footer">
    
  </div>
</form>

@push('extra_scripts')
  <script type="text/javascript">
    
  </script>
@endpush