<form class="form-horizontal" role="form" method="" id="salesline_form">
  {{csrf_field()}} 
  
  </div>
  <div class="form-group">
    <div class="panel-group" id="accordion">
      <div class="panel panel-success">
        <div class="panel-heading">
          <h4><a href="#coll-header" data-toggle="collapse" >Payment Header</a></h4>
        </div>
        <div id="coll-header" class="panel-collapse collapse">
          <div class="panel-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6">
                  <b>Payment No.</b> {{$payment->payment_no}} <br>
                  <b>Payment Mode: </b> {{$payment->payment_mode}} <br>
                  <b>Payment Type: </b>{{$payment->payment_type}} <br>
                </div>
                <div class="col-md-6">
                  <b>Payment Type: </b>{{$payment->payment_status}} <br>
                  <b>Payment Date: </b>{{$payment->created_at}} <br>
                </div>
                <div class="col-md-6">
                  <b>Amount Paid: </b>{{$payment->payment_amount}} <br>
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
      <div class="panel panel-success">
        <div class="panel-heading">
          <h4><a href="#coll-deatils" data-toggle="collapse">Payment Lines</a></h4>
        </div>
        <div id="coll-deatils" class="panel-collapse collapse">
          <div class="panel-body">
            <div class="table table-responsive sales-table col-md-11">
              <div>
                <div class="alert alert-danger" style="display:none"></div>
              </div>
              <table class="table table-bordered">
                <thead>
                  <tr bgcolor="yellow" id="tableheader">
                    <th width="150px">Order No.</th>
                    <th>Date Ordered</th>
                    <th>Delievery Code</th>
                    <th>Delivery Date</th>
                    <th>Net Amount</th>
                  </tr>
                </thead>
                @php
                  $netAmount = 0;
                  $amountPaid = 0;
                @endphp
                <tbody id="salesline-table-body">
                 @foreach($payment_lines as $line)
                    @foreach($orderlines as $orderline)
                      @if($orderline->order == $line->order_id)
                        @foreach($products as $product)
                          @if($product->id == $orderline->product)
                            @php
                              $netAmount = $netAmount + $product->total_price;
                            @endphp
                          @endif
                        @endforeach
                      @endif
                    @endforeach
                      <tr>
                        <td><a href="/orders/{{$line->order_id}}">{{$line->order_id}}</a></td>
                        <td>{{$line->created_at}}</td>
                        <td>{{$line->deliveryID}}</td>
                        <td>{{$line->delivery_date}}</td>
                        <td style="text-align: right">{{$netAmount}}</td>
                      </tr>
                      @php
                        $amountPaid = $amountPaid + $netAmount;
                      @endphp
                 @endforeach
                 <tr>
                   <td><b>Total:</b></td>
                   
                   <td></td>
                   <td></td>
                   <td></td>
                   <td style="text-align: right"><b>{{$amountPaid}}</b></td>
                 </tr>
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>

    </div>
  </div>
  <div class="modal-footer">
    <!-- <button class="btn btn-primary" type="button" onclick="settle_payment('{{$payment->payment_no}}')">Settle Payment</button> -->
    <button class="btn btn-warning" type="button" data-dismiss="modal">
      <span class="glyphicon glyphicon-remove"></span> Close
    </button>
  </div>
</form>
