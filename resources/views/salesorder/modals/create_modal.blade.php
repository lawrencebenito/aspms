<form class="form-horizontal" role="form" method="POST" id="create_form">
  {{csrf_field()}}
  <div class="alert alert-danger" style="display:none"></div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="title">Sales ID :</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="salesid" name="salesid" disabled value="{{$salesid}}">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="body">Customer Account :</label>
    <div class="col-sm-8">
      <select class="form-control" id="custaccount">
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
    <label class="control-label col-sm-4" for="body">Requested Delivery Date:</label>
    <div class="col-md-8">
      <input type="date" class="form-control" id="deliveryDate" name="deliveryDate" required>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-info" type="button" onclick="create()">
      <span class="glyphicon glyphicon-plus"></span> Save
    </button>
    <button class="btn btn-warning" type="button" data-dismiss="modal">
      <span class="glyphicon glyphicon-remove"></span> Close
    </button>
  </div>
</form>