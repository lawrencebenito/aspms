@extends('layouts.main')

@section('page_header')
  @include('garments.header')
@endsection

@section('content')

@if (session()->has('edited_garment'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Editing Successful!</h4>
      Changes made for this garment.
    </div>
  </div>
</div>
@elseif(session()->has('price_updated'))
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Price Updating Successful!</h4>
      New price was set to this record. Note: It is not allowed to update price for the same day.
    </div>
  </div>
</div>
@endif

<div class="row">
  <div class="col-md-9">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">View garment Information</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form" method="POST" action="{{ url('/garments') }}" onsubmit="return validate(this);">
        @CSRF
        <div class="box-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="col-sm-12 form-group">
                <label class="control-label">Name</label>
                <p>{{$garment->name}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Segment List</label>
                <p>
                @foreach ($segment_list as $segment)
                  {{$segment->name}},
                @endforeach
                </p>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Operation List</label>
                <p>
                @foreach ($operation_list as $operation)
                  {{$operation->name}},
                @endforeach
                </p>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Fabric List</label>
                <p>
                @foreach ($fabric_list as $fabric)
                  {{$fabric->name}},
                @endforeach
                </p>               
              </div>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
            </div>
            <!-- /.col-lg -->
          </div> 
          <!-- /.row inner -->   
        <div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a type="button" class="btn btn-default" href="{{url('/garments')}}">Back to List</a>
        </div>
        <!-- /.box-footer -->
      </form>
      <!-- /.form-horizontal -->
    </div>
    <!-- /.box-primary -->
  </div>
  <!-- /.col -->
  </div>
  </div>  
  <div class="col-md-3">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Options</h3>
      </div>
      <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-sm-12">
              <a type="button" class="btn btn-primary btn-block" href="{{ url('./garments')}}/{{$garment->id}}/edit"><i class="fa fa-edit"></i> Edit</a>
              <a type="button" class="btn btn-primary btn-block" href="{{ url('./garments')}}/{{$garment->id}}/delete"><i class="fa fa-trash-o"></i> Delete</a>
            </div>
            <!-- /.col -->
          </div> 
          <!-- /.row inner -->   
        <div>
        <!-- /.box-body -->
        <div class="box-footer"></div>
        <!-- /.box-footer -->
      </form>
      <!-- /.form-horizontal -->
    </div>
    <!-- /.box box-primary -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
@endsection

@push('extra_scripts')
<script>
  var date = parse_date($('#date_effective').val())
  $('#display_date').text(date.text);
</script>
@endpush