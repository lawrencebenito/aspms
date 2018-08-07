@extends('layouts.main')

@section('page_header')
  @include('workers.header')
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add New Worker Profile</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form" method="POST" action="{{ url('/workers') }}" onsubmit="return validate(this);">
          @CSRF
          <div class="box-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="col-sm-12 form-group">
                  <label class="control-label">Last Name</label>
                  <input type="text" class="form-control" placeholder="Worker's last name" name="last_name" autocomplete="off" required></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">First Name</label>
                  <input type="text" class="form-control" placeholder="Worker's first name" name="first_name" autocomplete="off" required></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Middle Name</label>
                  <input type="text" class="form-control" placeholder="Worker's middle name" name="middle_name" autocomplete="off"></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Contact Number</label>
                  <input type="text" class="form-control" placeholder="Worker's contact number" name="contact_number" autocomplete="off" required></input>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-sm-6">
                <div class="col-sm-12 form-group">
                  <label class="control-label">Email Address</label>
                  <input type="email" class="form-control" placeholder="Worker's email address" name="email_address" autocomplete="off"></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Address</label>
                  <textarea rows="3" class="form-control" placeholder="Worker's Address" name="address" maxlength="200" style="resize:none;"></textarea>
                </div>
              </div>
              <!-- /.col-lg -->
            </div> 
            <!-- /.row inner -->   
          <div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a type="button" class="btn btn-default" href="{{url('/workers')}}">Cancel</a>
            <button type="submit" class="btn btn-primary pull-right">Submit</button>
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