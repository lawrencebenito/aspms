@extends('layouts.main')

@section('page_header')
  @include('fabrics.header')
@endsection

@section('content')

@if (session()->has('edited_fabric'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Editing Successful!</h4>
    Changes made for this fabric: {{ session()->get('edited_fabric') }}.
  </div>
@endif

<div class="row">
  <div class="col-md-9">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">View Fabric Information</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form" method="POST" action="{{ url('/fabrics') }}" onsubmit="return validate(this);">
        @CSRF
        <div class="box-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="col-sm-12 form-group">
                <label class="control-label">Color</label>
                <p>{{$fabric->color}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Pattern</label>
                <p>{{$fabric->pattern_name}}</p>             
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Type</label>
                <p>{{$fabric->type_name}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Supplier</label>
                <p>{{$fabric->supplier_name}}</p>                
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Reference Number</label>
                <p>{{$fabric->reference_num}}</p>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <div class="col-sm-12 form-group">
                <label class="control-label">Fabrication</label>
                <p>{{$fabric->fabrication}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">GSM</label>
                <p>{{$fabric->gsm}}</p>
              </div>
              <div class="col-sm-12 form-group">
                <label class="control-label">Fabric Width Inch</label>
                <p>{{$fabric->width}}</p>
              </div>
            </div>
            <!-- /.col-lg -->
          </div> 
          <!-- /.row inner -->   
        <div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a type="button" class="btn btn-default" href="{{url('/fabrics')}}">Back to List</a>
          <button type="submit" class="btn btn-primary pull-right">Submit</button>
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
              <a type="button" class="btn btn-primary btn-block" href="{{ url('./fabrics')}}/{{$fabric->id}}/edit"><i class="fa fa-edit"></i> Edit</a>
              <a type="button" class="btn btn-primary btn-block" href="{{ url('./fabrics')}}/{{$fabric->id}}/delete"><i class="fa fa-trash-o"></i> Delete</a>
              <a type="button" class="btn btn-primary btn-block"> View Contracts</a>
              <a type="button" class="btn btn-primary btn-block"> View Quotations</a>
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