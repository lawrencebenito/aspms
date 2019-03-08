<form class="form-horizontal" role="form" method="" id="salesline_form">
  {{csrf_field()}}
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

      <div class="panel panel-info">
        <div class="panel-heading">
          <h4><a href="#coll-deatils" data-toggle="collapse">Sales Order Lines</a></h4>
        </div>
        <div id="coll-deatils" class="panel-collapse collapse">
          <div class="panel-body">
            <div class="table table-responsive sales-table col-md-11">
              <button type="button" class="btn btn-success" onclick="addRow()"><i class="glyphicon glyphicon-plus"></i> Add line</button>
              <div class="alert alert-danger" style="display:none"></div>
              <table class="table table-bordered">
                <thead>
                  <tr bgcolor="yellow">
                    <th width="150px">Item No.</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Quantity</th>
                    <th>Net Amount</th>
                    <th class="text-center">
                      
                    </th>
                  </tr>
                </thead>
                <tbody id="salesline-table-body">
                  
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>

    </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-info" type="button" onclick="saveLine('{{$sales_order->salesID}}')">
      <span class="glyphicon glyphicon-plus"></span> Save
    </button>
    <button class="btn btn-warning" type="button" data-dismiss="modal">
      <span class="glyphicon glyphicon-remove"></span> Close
    </button>
  </div>
</form>