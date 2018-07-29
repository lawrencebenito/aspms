@extends('layouts.main')

@section('page_header')
  @include('workers.header')
@endsection

@section('content')

@if (session()->has('edited_worker'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Editing Successful!</h4>
    Changes made for this worker: {{ session()->get('edited_worker') }}.
  </div>
@endif

<div class="row">
  <div class="col-md-9">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">View Worker Profile</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form">
        <div class="box-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="col-sm-12 form-group">
                <label>Last Name</label>
                <p>{{$worker->last_name}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>First Name</label>
                <p>{{$worker->first_name}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Middle Name</label>
                <p>{{$worker->middle_name}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Contact Number</label>
                <p>{{$worker->contact_number}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Email Address</label>
                <p>{{$worker->email_address}}</p>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <div class="col-sm-12 form-group">
                <label>Address</label>
                <p>{{$worker->address}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Account Status</label>
                <p>{{($worker->active == 0 ? 'Inactive':'Active')}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Date Created</label>
                <p>{{$worker->date_created}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Date Modified</label>
                <p>{{$worker->date_modified}}</p>
              </div>
            </div>
            <!-- /.col-lg -->
          </div> 
          <!-- /.row inner -->   
        <div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a type="button" class="btn btn-default" href="{{url('/workers')}}">Back to List</a>
        </div>
        <!-- /.box-footer -->
      </form>
      <!-- /.form-horizontal -->
    </div>
    <!-- /.box box-success -->
  </div>
  <!-- /.col -->
  </div>
  </div>  
  <div class="col-md-3">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Other Options</h3>
      </div>
      <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-sm-12">
              <a type="button" class="btn btn-primary btn-block" href="{{ url('./workers')}}/{{$worker->id}}/edit"><i class="fa fa-edit"></i> Edit Info</a>
              <a type="button" class="btn btn-primary btn-block"><i class="fa fa-edit"></i> Edit User Account</a>
              <a type="button" class="btn btn-primary btn-block"><i class="fa fa-file-text-o"></i> View Production Log</a>
            </div>
            <!-- /.col -->
          </div> 
          <!-- /.row inner -->   
        <div>
        <!-- /.box-body -->
        <div class="box-footer">

        </div>
        <!-- /.box-footer -->
      </form>
      <!-- /.form-horizontal -->
    </div>
    <!-- /.box box-success -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
@endsection

@section('extra_scripts')

@endsection