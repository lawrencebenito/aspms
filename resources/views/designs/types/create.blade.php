@extends('layouts.main')

@section('page_header')
  @include('designs.header')
@endsection

@section('content')
<div class="row">
  <div class="col-lg-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add New Design Type </h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form" method="POST" action="{{ URL('/design_types')}}" onsubmit="return validate(this);">
          @CSRF
          <div class="box-body">
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-12 form-group">
                  <label class="control-label">Design Type Name</label>
                  <input type="text" class="form-control" placeholder="eg. Embroidery, Silk Screen, Hot Press" name="name" autocomplete="off" required></input>
                </div>
              </div>
              <!-- /.col -->
            </div> 
            <!-- /.row inner -->   
          <div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a type="button" class="btn btn-default" href="{{url('/designs')}}">Cancel</a>
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