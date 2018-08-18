@extends('layouts.main')

@section('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
@endsection

@section('page_header')
  <i class="fa fa-shopping-cart"></i> Orders
@endsection

@section('content')
<div class="box box-solid box-info source">
  <div class="box-header">
    <h3 class="box-title">List of Current Orders of Clients</h3>      
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive no-padding">
    <table class="table table-hover">
      <tbody><tr>
        <th style="width: 80px">Order #</th>
        <th>Client Name</th>
        <th>Total Cost</th>
        <th>Payment Status</th>
        <th>Due Date</th>
        <th>Production Progress</th>
        <th>Action</th>
      </tr>
      <tr>
        <td>ORD-301</td>
        <td>John Doe</td>
        <td>PHP 3,000</td>
        <td><span class="label label-success">Received</span></td>
        <td>04-06-2018</td>
        <td><span class="badge bg-yellow">55%</span></td>
        <td>
          <button class="btn btn-xs" data-toggle="tooltip" title="Generate Invoice">
            <i class="fa fa-file-text-o"></i> Invoice
          </button>
          <button class="btn btn-xs" data-toggle="tooltip" title="Generate Reciept">
            <i class="fa fa-sticky-note-o"></i> Reciept
          </button>
          <button class="btn btn-xs" data-toggle="tooltip" title="Generate Delivery Reciept">
            <i class="fa fa-pencil-square-o"></i> Delivery Reciept
          </button>
        </td>
      </tr>
      </tr>
      <tr>
        <td>ORD-302</td>
        <td>Alexander Pierce</td>
        <td>PHP 5,000</td>
        <td><span class="label label-danger">Delayed</span></td>
        <td>04-01-2018</td>
        <td><span class="badge bg-light-blue">70%</span></td>
        <td>
          <button class="btn btn-xs" data-toggle="tooltip" title="Generate Invoice">
            <i class="fa fa-file-text-o"></i> Invoice
          </button>
          <button class="btn btn-xs" data-toggle="tooltip" title="Generate Reciept">
            <i class="fa fa-sticky-note-o"></i> Reciept
          </button>
          <button class="btn btn-xs" data-toggle="tooltip" title="Generate Delivery Reciept">
            <i class="fa fa-pencil-square-o"></i> Delivery Reciept
          </button>
          </td>
      </tr>
      <tr>
        <td>ORD-303</td>
        <td>Mike Doe</td>
        <td>PHP 7,000</td>
        <td><span class="label label-warning">Pending</span></td>
        <td>05-01-2018</td>
        <td><span class="badge bg-red">30%</span></td>
        <td>
          <button class="btn btn-xs" data-toggle="tooltip" title="Generate Invoice">
            <i class="fa fa-file-text-o"></i> Invoice
          </button>
          <button class="btn btn-xs" data-toggle="tooltip" title="Generate Reciept">
            <i class="fa fa-sticky-note-o"></i> Reciept
          </button>
          <button class="btn btn-xs" data-toggle="tooltip" title="Generate Delivery Reciept">
            <i class="fa fa-pencil-square-o"></i> Delivery Reciept
          </button>
        </td>
      </tr>
      <tr>
        <td>ORD-304</td>
        <td>Zachary Wyman</td>
        <td>PHP 3,000</td>
        <td><span class="label label-success">Received</span></td>
        <td>03-28-2018</td>
        <td><span class="badge bg-green">90%</span></td>
        <td>
          <button class="btn btn-xs" data-toggle="tooltip" title="Generate Invoice">
            <i class="fa fa-file-text-o"></i> Invoice
          </button>
          <button class="btn btn-xs" data-toggle="tooltip" title="Generate Reciept">
            <i class="fa fa-sticky-note-o"></i> Reciept
          </button>
          <button class="btn btn-xs" data-toggle="tooltip" title="Generate Delivery Reciept">
            <i class="fa fa-pencil-square-o"></i> Delivery Reciept
          </button>
        </td>
      </tr>
      </tbody></table>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="pull-right">
      <button type="button" class="btn btn-flat btn-info show-add-form"><i class="fa fa-plus"></i> New Order</button>
      <button type="button" class="btn btn-flat btn-info"><i class="fa fa-pie-chart"></i> View Report</button>
    </div>
  </div>
  <!-- box-footer -->
</div>
<div class="row">
  <div class="col-lg-9">
    <div class="box box-info add-form" style="display: none">
      <div class="box-header with-border">
        <h3 class="box-title">Add Order</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form">
        <div class="box-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Client Name</label>
            <select class="form-control">
              <option>John Doe</option>
              <option>Alexander Pierce</option>
              <option>Bob Doe</option>
              <option>Mike Doe</option>
            </select>
          </div>
          <div class="form-group">
            <label>Order Details</label>
            <div class="box-body table-responsive">
              <table class="table table-hover">
                <tr>
                  <th>Quantity</th>
                  <th>Product Description</th>
                  <th>Unit Price</th>
                  <th>Price</th>
                </tr>
                <tr>
                  <td><input type="text" class="form-control" id=></td>
                  <td>
                    <select class="form-control">
                      <option>T-Shirt</option>
                      <option>Pants</option>
                      <option>Chef Jacket</option>
                      <option>Cargo Chef Pants</option>
                      <option>Aprons</option>
                    </select>
                  </td>
                  <td><input type="text" class="form-control" id=></td>
                  <td><input type="text" class="form-control" id=></td>
                </tr>
                <tr>
                  <td><input type="text" class="form-control"></td>
                  <td>
                    <select class="form-control">
                      <option>T-Shirt</option>
                      <option>Pants</option>
                      <option>Chef Jacket</option>
                      <option>Cargo Chef Pants</option>
                      <option>Aprons</option>
                    </select>
                  </td>
                  <td><input type="text" class="form-control"></td>
                  <td><input type="text" class="form-control"></td>
                </tr>
                <tr>
                  <td><input type="text" class="form-control"></td>
                  <td>
                    <select class="form-control">
                      <option>T-Shirt</option>
                      <option>Pants</option>
                      <option>Chef Jacket</option>
                      <option>Cargo Chef Pants</option>
                      <option>Aprons</option>
                    </select>
                  </td>
                  <td><input type="text" class="form-control"></td>
                  <td><input type="text" class="form-control"></td>
                </tr>
                <tr>
                  <td><input type="text" class="form-control"></td>
                  <td>
                    <select class="form-control">
                      <option>T-Shirt</option>
                      <option>Pants</option>
                      <option>Chef Jacket</option>
                      <option>Cargo Chef Pants</option>
                      <option>Aprons</option>
                    </select>
                  </td>
                  <td><input type="text" class="form-control"></td>
                  <td><input type="text" class="form-control"></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="form-group">
            <label for="inputTotalPrice">Total Price</label>
            <input type="text" class="form-control" id="inputTotalPrice" placeholder="Total Price">
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="button" class="btn btn-default close-add-form">Cancel</button>
          <button type="button" class="btn btn-info pull-right close-add-form">Submit</button>
        </div>
        <!-- /.box-footer -->
      </form>
      <!-- /.add-form -->
    </div>
  </div>
  <!-- /.col-->
</div>
<!-- /.row-->
@endsection

@section('extra_scripts')
<!-- DataTables -->
<script src="{{ asset("bower_components/datatables.net/js/jquery.dataTables.min.js")}}"></script>
<script src="{{ asset("bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>

<script>
$(document).ready(function(){
    $(".show-add-form").click(function(){
        $(".source").fadeOut(500);
        $(".add-form").show(2000);
    });
    $(".show-add-form-wc").click(function(){
        $(".add-form").show(2000);
    });

    $(".close-add-form").click(function(){
        $(".add-form").slideUp(500);
        $(".source").slideDown(1500);
    });
} ); //end of document.ready

</script>
@endsection