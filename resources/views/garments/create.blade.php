@extends('layouts.main')

@section('page_header')
  @include('garments.header')
@endsection

@section('content')
<div class="row">
  <div class="col-lg-6">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Add New Garment </h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form" method="POST" action="{{ url('/garments') }}" onsubmit="return validate(this);">
          @CSRF
          <div class="box-body">
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-12 form-group">
                  <label class="control-label">Name</label>
                  <input type="text" class="form-control" placeholder="Garment's Name eg. T-shirt" name="name" required autocomplete="off"></input>
                </div>
              </div>
              <!-- /.col -->
            </div> 
            <!-- /.row inner -->   
          <div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a type="button" class="btn btn-default" href="{{ url('/garments') }}">Cancel</a>
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