@extends('layouts.main')

@section('page_header')
  @include('clients.header')
@endsection

@section('content')

@if (session()->has('edited_client'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Editing Successful!</h4>
    Changes made for this client: {{ session()->get('edited_client') }}.
  </div>
@endif

<div class="row">
  <div class="col-md-9">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">View Client Profile</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form">
        <div class="box-body">
          <div class="row">
            <input type="hidden" value="" id="id" name="id" >
            <div class="col-sm-6">
              <div class="col-sm-12 form-group">
                <label>Company Name</label>
                <p>{{$client->company_name ? : 'N/A'}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Last Name</label>
                <p>{{$client->last_name}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>First Name</label>
                <p>{{$client->first_name}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Middle Name</label>
                <p>{{$client->middle_name ? : 'N/A'}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Contact Number</label>
                <p>{{$client->contact_num}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Email Address</label>
                <p>{{$client->email_address}}</p>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <div class="col-sm-12 form-group">
                <label>Address Line</label>
                <p>{{$client->address_line}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Address Municipality</label>
                <p>{{$client->address_municipality}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Address Province</label>
                <p>{{$client->address_province}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Account Status</label>
                <p>{{($client->active == 1 ? 'Active':'Inactive')}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Date Created</label>
                <p>{{$client->date_created}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Date Modified</label>
                <p>{{$client->date_modified}}</p>
              </div>
            </div>
            <!-- /.col-lg -->
          </div> 
          <!-- /.row inner -->   
        <div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a type="button" class="btn btn-default" href="{{url('/clients')}}">Back to List</a>
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
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Other Options</h3>
      </div>
      <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-sm-12">
              <a type="button" class="btn btn-success btn-block" href="{{ url('./clients')}}/{{$client->id}}/edit"><i class="fa fa-edit"></i> Edit Info</a>
              <a type="button" class="btn btn-success btn-block"><i class="fa fa-file-text-o"></i> Generate Contract</a>
              <a type="button" class="btn btn-success btn-block disabled"><i class="fa fa-search"></i> View Contract</a>
              <a type="button" class="btn btn-success btn-block">View Quotations</a>
              <a type="button" class="btn btn-success btn-block">View Products</a>
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