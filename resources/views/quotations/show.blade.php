@extends('layouts.main')

@section('page_header')
  @include('quotations.header')
@endsection

@section('content')

@if (session()->has('edited_quotation'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Editing Successful!</h4>
    Changes made for this quotation: {{ session()->get('edited_quotation') }}.
  </div>
@endif

<div class="row">
  <div class="col-md-12">
    <div class="box box-primary box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">View Quotation</h3>
        <div class="box-tools">
          <div class="input-group input-group-md" style="width: 150px;">
            <div class="input-group-btn">
              <a class="btn pull-right" href="./quotations/create">
                <i class="fa fa-edit"></i> Edit
              </a>
              <a class="btn pull-right" href="./quotations/create">
                <i class="fa fa-trash-o"></i> Delete 
              </a>
            </div>
          </div>
        </div>
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
                <p>{{$quotation->company_name ? : 'N/A'}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Last Name</label>
                <p>{{$quotation->last_name}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>First Name</label>
                <p>{{$quotation->first_name}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Middle Name</label>
                <p>{{$quotation->middle_name ? : 'N/A'}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Contact Number</label>
                <p>{{$quotation->contact_num}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Email Address</label>
                <p>{{$quotation->email_address}}</p>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <div class="col-sm-12 form-group">
                <label>Address Line</label>
                <p>{{$quotation->address_line}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Address Municipality</label>
                <p>{{$quotation->address_municipality}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Address Province</label>
                <p>{{$quotation->address_province}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Account Status</label>
                <p>{{($quotation->active == 1 ? 'Active':'Inactive')}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Date Created</label>
                <p>{{$quotation->date_created}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label>Date Modified</label>
                <p>{{$quotation->date_modified}}</p>
              </div>
            </div>
            <!-- /.col-lg -->
          </div> 
          <!-- /.row inner -->   
        <div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a type="button" class="btn btn-default" href="{{url('/quotations')}}">Back to List</a>
        </div>
        <!-- /.box-footer -->
      </form>
      <!-- /.form-horizontal -->
    </div>
    <!-- /.box box-primary -->
  </div>
  <!-- /.col -->
  </div>
  </div>
</div>
<!-- /.row -->
@endsection