@extends('layouts.main')

@section('page_header')
  <i class="fa fa-wrench"></i> Status
@endsection

@section('content')
<div class="row">
  <div class="col-lg-6">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Add New Status </h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form" method="POST" action="{{ URL('/status')}}" onsubmit="return validate(this);">
          @CSRF
          <div class="box-body">
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-12 form-group">
                  <label class="control-label">Status Name</label>
                  <input type="text" class="form-control" placeholder="eg. Completed, Pending, Waiting for Approval, etc." name="description" autocomplete="off" required></input>
                </div>
              </div>
              <!-- /.col -->
            </div> 
            <!-- /.row inner -->   
          <div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a type="button" class="btn btn-default" href="{{url('/status')}}">Cancel</a>
            <button type="submit" class="btn btn-warning pull-right">Submit</button>
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