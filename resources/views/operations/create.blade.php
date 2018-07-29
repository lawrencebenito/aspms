@extends('layouts.main')

@section('page_header')
  <i class="ion ion-scissors"></i> Operations
@endsection

@section('content')
<div class="row">
  <div class="col-lg-6">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Add New Operation </h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form" method="POST" action="{{ URL('/operations')}}" onsubmit="return validate(this);">
          @CSRF
          <div class="box-body">
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-12 form-group">
                  <label class="control-label">Operation Name</label>
                  <input type="text" class="form-control" placeholder="eg. Cutting, Leg Bias, Piping, Packaging" name="name" autocomplete="off" required></input>
                </div>
              </div>
              <!-- /.col -->
            </div> 
            <!-- /.row inner -->   
          <div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a type="button" class="btn btn-default" href="{{url('/operations')}}">Cancel</a>
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
        return confirm('Do you really want to submit the form?');
    }
}
</script>
@endsection