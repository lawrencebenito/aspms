@extends('layouts.main')

@section('page_header')
  @include('clients.header')
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Client Profile</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form" method="POST" action="{{ URL('/clients')}}/{{$client->id}}" onsubmit="return validate(this);">
          @CSRF
          <div class="box-body">
            <div class="row">
              <input type="hidden" value="" id="id" name="id" >
              <div class="col-sm-6">
                <div class="col-sm-12 form-group">
                  <label class="control-label">Company Name</label>
                  <input type="text" class="form-control" value="{{$client->company_name}}" name="company_name"></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Last Name</label>
                  <input type="text" class="form-control" value="{{$client->last_name}}" name="last_name" autocomplete="off" required></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">First Name</label>
                  <input type="text" class="form-control" value="{{$client->first_name}}" name="first_name" autocomplete="off" required></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Middle Name</label>
                  <input type="text" class="form-control" value="{{$client->middle_name}}" name="middle_name" autocomplete="off"></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Contact Number</label>
                  <input type="text" class="form-control" value="{{$client->contact_num}}" name="contact_num" autocomplete="off" required></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Email Address</label>
                  <input type="email" class="form-control" value="{{$client->email_address}}" name="email_address" autocomplete="off" required></input>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-sm-6">
                <div class="col-sm-12 form-group">
                  <label class="control-label">Address Line</label>
                  <input type="text" class="form-control" value="{{$client->address_line}}" name="address_line" autocomplete="off" required></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Address Municipality</label>
                  <input type="text" class="form-control" value="{{$client->address_municipality}}" name="address_municipality" autocomplete="off" required></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Address Province</label>
                  <input type="text" class="form-control" value="{{$client->address_province}}" name="address_province" autocomplete="off" required></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Account Status</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="active" value="1" {{$client->active == 1 ? 'checked':''}}>
                      Active
                    </label>
                    <label>
                      <input type="radio" name="active" value="0" {{$client->active == 0 ? 'checked':''}}>
                      Inactive
                    </label>
                  </div>
                </div>
                <div class="col-sm-9 form-group">
                  <div class="row">
                    <div class="col-sm-6">
                      <label>Date Created</label>
                      <p class="help-block">{{$client->date_created}}</p>
                    </div>
                    <div class="col-sm-6">
                      <label>Date Modified</label>
                      <p class="help-block">{{$client->date_modified}}</p>
                    </div>
                  </div>

                </div>
              </div>
              <!-- /.col-lg -->
            </div> 
            <!-- /.row inner -->   
          <div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a type="button" class="btn btn-default" onclick="history.back(-1)">Cancel</a>
            {{ method_field('PUT') }}
            <button type="submit" class="btn btn-success pull-right">Save</button>
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