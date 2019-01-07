@extends('layouts.main')

@push('extra_links')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset("bower_components/select2/dist/css/select2.min.css")}}">
@endpush

@section('page_header')
  @include('garments.header')
@endsection

@section('content')
<div class="row">
  <div class="col-lg-8">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add New Garment</h3>
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
                  <input type="text" class="form-control" placeholder="Garment's Name eg. T-shirt, Polo, Polo-Shirt, Pants, Shorts etc." name="name" required autocomplete="off">
                </div>
                <div class="col-sm-12 form-group">
                  <label>Assign Fabrics</label>
                  <select id="fabrics" name="fabrics[]" class="form-control select2" multiple="multiple" style="width: 100%;" required>
                  </select>                      
                </div>
                
              </div>
              <!-- /.col -->
            </div> 
            <!-- /.row inner -->   
          <div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a type="button" class="btn btn-default" href="{{ url('/garments') }}">Cancel</a>
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

@push('extra_scripts')
<!-- Select2 -->
<script src="{{ asset("bower_components/select2/dist/js/select2.full.min.js")}}"></script>

<script>
$(document).ready(function(){
  
  $('#fabrics.select2').select2({
    placeholder: "Select Allowed Fabrics",
    ajax: {
      method: 'get',
      url: '../get_fabric_type_list',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results: data
        };
      }
    }
  });

}); //end of document.ready
</script>
@endpush