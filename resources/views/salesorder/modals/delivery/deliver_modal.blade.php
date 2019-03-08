<form>
  <div class="form-group">
    <label for="deliveryID" class="col-form-label">Delivery ID:</label>
    <input type="text" class="form-control" id="deliveryID" disabled value="{{$deliveryID}}">
  </div>
  <div class="form-group">
    <label for="deliveryMode" class="col-form-label">Delivery Mode:</label>
    <input type="text" class="form-control" id="deliveryMode" >
  </div>
  <div class="form-group">
    <label for="deliveryAddress" class="col-form-label">Delivery Address:</label>
    <input type="text" class="form-control" id="deliveryAddress" >
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-primary" onclick="deliver()">Deliver</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
</form>