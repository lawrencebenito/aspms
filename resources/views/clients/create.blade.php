@extends('layouts.main')

@section('page_header')
  @include('clients.header')
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Sales</a></li>
    <li>Clients</li>
    <li class="active">Add Client</li>
  </ol>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Add New Client Profile</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form" method="POST" action="{{ url('/clients') }}" onsubmit="return validate(this);">
          @CSRF
          <div class="box-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="col-sm-12 form-group">
                  <label class="control-label">Company Name</label>
                  <input type="text" class="form-control" placeholder="Name of the client's company" name="company_name" autocomplete="off"</input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Last Name</label>
                  <input type="text" class="form-control" placeholder="Client's last name" name="last_name" autocomplete="off" required></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">First Name</label>
                  <input type="text" class="form-control" placeholder="Client's first name" name="first_name" autocomplete="off" required></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Middle Name</label>
                  <input type="text" class="form-control" placeholder="Client's middle name" name="middle_name" autocomplete="off"></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Contact Number</label>
                  <input type="text" class="form-control" placeholder="Client's contact number" name="contact_num" autocomplete="off" required></input>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-sm-6">
                <div class="col-sm-12 form-group">
                  <label class="control-label">Email Address</label>
                  <input type="email" class="form-control" placeholder="Client's email address" name="email_address" autocomplete="off" required></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Address Line</label>
                  <input type="text" class="form-control" placeholder="Block #, Lot #, Bldg #, Street, Subdivision" name="address_line" autocomplete="off" required></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Address Municipality</label>
                  <input type="text" class="form-control" placeholder="City or Municipality eg. Manila, Makati, Cainta" name="address_municipality" autocomplete="off" required></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Address Province</label>
                  <input type="text" class="form-control" placeholder="Region or Province eg. Metro Manila, Cavite, Rizal" name="address_province" autocomplete="off" required></input>
                </div>
              </div>
              <!-- /.col-lg -->
            </div> 
            <!-- /.row inner -->   
          <div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a type="button" class="btn btn-default" href="{{url('/clients')}}">Cancel</a>
            <button type="submit" class="btn btn-success pull-right">Submit</button>
          </div>
          <!-- /.box-footer -->
        </form>
        <!-- /.form-horizontal -->
      </div>
      <!-- /.add-form -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection