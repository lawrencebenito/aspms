<form>
  <div class="form-group">
    <label for="deliveryID" class="col-form-label col-md-4">Payments ID:</label>
    <div class="col-md-8">
      <input type="text" class="form-control" id="deliveryID" disabled value="{{$paymentID}}" style="margin-bottom: 15px;">
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-4" for="body">Customer Account :</label>
    <div class="col-sm-8">
      <select class="form-control" id="custaccount" onchange="get_client_orders(this.value)" style="margin-bottom: 15px;">
        <option value="" disabled="" selected="">---</option>
        @foreach($clients as $client)
          <option value="{{$client->id}}">
            {{$client->id}} - {{$client->company_name}}
          </option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="paymentMode" class="col-form-label col-md-4">Payment Mode:</label>
    <div class="col-md-8">
      <select class="form-control" id="paymentMode" style="margin-bottom: 15px;">
        <option value="" disabled="" selected="">---</option>
        <option value="Check" >Cash</option>
        <option value="Check" >Check</option>
        <option value="Electronic Transfer" >Electronic Transfer</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="paymentType" class="col-form-label col-md-4">Payment type:</label>
    <div class="col-md-8">
      <select class="form-control" id="paymentType" style="margin-bottom: 15px;">
        <option value="" disabled="" selected="">---</option>
        <option value="Partial" >Partial</option>
        <option value="Full" >Full</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="paymentamount" class="col-form-label col-md-4">Amount:</label>
    <div class="col-md-8">
      <input type="number" class="form-control" name="paymentamount" id="paymentamount" style="margin-bottom: 15px;">
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <table class="table table-bordered">
        <thead>
          <tr bgcolor="yellow" id="tableheader">
            <th></th>
            <th width="150px">Order No.</th>
            <th>Date Ordered</th>
            <th>Delievery Code</th>
            <th>Delivery Date</th>
            <th>Net Amount</th>
          </tr>
        </thead>
        <tbody id="clientorders-table">
          
        </tbody>
      </table>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-primary" onclick="save_payment('{{$paymentID}}')">Save</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
</form>