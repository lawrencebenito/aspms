@extends('layouts.main')

@section('page_header')
  <i class="fa fa-wrench"></i> Status
@endsection

@section('content')
<div class="row">
  <div class="col-lg-6">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Status Information</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form" method="POST" action="{{ URL('/status')}}/{{$status->id}}" onsubmit="return validate(this);">
          @CSRF
          <div class="box-body">
            <div class="row">
              <div class="col-sm-12">
               <div class="col-sm-12 form-group">
                  <label class="control-label">Status Name</label>
                  <input type="text" class="form-control" value="{{$status->description}}" name="description" autocomplete="off" required></input>
                </div>
              </div>
              <!-- /.col -->
            </div> 
            <!-- /.row inner -->   
          <div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a type="button" class="btn btn-default" href="{{ url('/status') }}">Cancel</a>
            {{ method_field('PUT') }}
            <button type="submit" class="btn btn-info pull-right">Save</button>
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

@section('extra_scripts')
<script>
  function validate(form) {
      valid = true;
      // validation code here ...
        
      if(!valid) {
          alert('Please correct the errors in the form!');
          return false;
      }
      else {
          return confirm('Do you really want to save the following changes?');
      }
  }
</script>
@endsection