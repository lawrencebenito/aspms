@extends('layouts.main')

@section('page_header')
  @include('workers.header')
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Worker Profile</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form" method="POST" action="{{ URL('/workers')}}/{{$worker->id}}" onsubmit="return validate(this);">
          @CSRF
          <div class="box-body">
            <div class="row">
              <div class="col-sm-6">
               <div class="col-sm-12 form-group">
                  <label class="control-label">Last Name</label>
                  <input type="text" class="form-control" value="{{$worker->last_name}}" name="last_name" autocomplete="off" required></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">First Name</label>
                  <input type="text" class="form-control" value="{{$worker->first_name}}" name="first_name" autocomplete="off" required></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Middle Name</label>
                  <input type="text" class="form-control" value="{{$worker->middle_name}}" name="middle_name" autocomplete="off"></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Contact Number</label>
                  <input type="text" class="form-control" value="{{$worker->contact_number}}" name="contact_number" autocomplete="off" required></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Email Address</label>
                  <input type="email" class="form-control" value="{{$worker->email_address}}" name="email_address" autocomplete="off"></input>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-sm-6">
                <div class="col-sm-12 form-group">
                  <label class="control-label">Address</label>
                  <textarea rows="3" class="form-control" name="address" maxlength="200" style="resize:none;">{{$worker->address}}</textarea>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Account Status</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="active" value="1" {{$worker->active == 1 ? 'checked':''}}>
                      Active
                    </label>
                    <label>
                      <input type="radio" name="active" value="0" {{$worker->active == 0 ? 'checked':''}}>
                      Inactive
                    </label>
                  </div>
                </div>
                <div class="col-sm-9 form-group">
                  <div class="row">
                    <div class="col-sm-6">
                      <label>Date Created</label>
                      <p class="help-block">{{$worker->date_created}}</p>
                    </div>
                    <div class="col-sm-6">
                      <label>Date Modified</label>
                      <p class="help-block">{{$worker->date_modified}}</p>
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
            <button type="submit" class="btn btn-primary pull-right">Save</button>
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