@extends('layouts.main')

@section('page_header')
  @include('garments.header')
@endsection

@section('content')
<div class="row">
  <div class="col-lg-6">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Garment Information</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form" method="POST" action="{{ url('/garments')}}/{{$garment->id}}" onsubmit="return validate(this);">
          @CSRF
          <div class="box-body">
            <div class="row">
              <div class="col-sm-12">
               <div class="col-sm-12 form-group">
                  <label class="control-label">Name</label>
                  <input type="text" class="form-control" value="{{$garment->name}}" name="name" required autocomplete="off"></input>
                </div>
                <div class="col-sm-12 form-group">
                  <label class="control-label">Status</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="active" value="1" {{$garment->active == 1 ? 'checked':''}}>
                      Active
                    </label>
                    <label>
                      <input type="radio" name="active" value="0" {{$garment->active == 0 ? 'checked':''}}>
                      Inactive
                    </label>
                  </div>
                </div>
                <div class="col-sm-9 form-group">
                  <div class="row">
                    <div class="col-sm-6">
                      <label>Date Created</label>
                      <p class="help-block">{{$garment->date_created}}</p>
                    </div>
                    <div class="col-sm-6">
                      <label>Date Modified</label>
                      <p class="help-block">{{$garment->date_modified}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col -->
            </div> 
            <!-- /.row inner -->   
          <div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a type="button" class="btn btn-default" href="{{ url('/garments') }}">Cancel</a>
            {{ method_field('PUT') }}
            <button type="submit" class="btn btn-warning pull-right">Save</button>
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