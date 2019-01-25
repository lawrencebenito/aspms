@extends('layouts.main')

@section('page_header')
  @include('products.header')
@endsection

@section('content')

@if (session()->has('edit'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Editing Successful!</h4>
    Changes made for this product was saved.
  </div>
@endif

<div class="row">
  <div class="col-md-9">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Viewing Product Description for <b>{{$product->style_number}}</b></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-sm-6">
            <div class="col-sm-12 form-group">
              <label>Date</label>
              <p id="date"></p>
              <input id="date_form" type="hidden" class="form-control" name="date_created" value="{{$product->date_created}}">
            </div>
            <div class="col-sm-12 form-group">
              <label>Client Name</label>
              <p>{{$product->client_name}}</p>
            </div>
            @if (!is_null($product->description))
              <div class="col-sm-12 form-group">
                <label>Product Description</label>
                <p>{{$product->description}}</p>
              </div>
            @endif
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <div class="col-sm-12 form-group">
              <label>Garment Type</label>
              <p>{{$product->garment_type}}</p>
            </div>
            <div class="col-sm-12 form-group">
              <label>Size Range</label>
              <p>{{$product->min_range}} to {{$product->max_range}}</p>
            </div>
            <div class="col-sm-12 form-group">
              <label>Consumption Size</label>
              <p>{{$product->consumption_size}}</p>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        
        <div class="col-sm-12 form-group">
          <h5 style="background: #f5f5f5; font-weight:bold">Segments and Fabrics</h5>
          <ul>
            @foreach($fabrics as $fabric)
            <li> {{$fabric->segment_name}} - {{$fabric->color}} {{$fabric->pattern_name}} {{$fabric->type_name}} ({{$fabric->reference_num}})</li>
            @endforeach
          </ul>
          <h5 style="background: #f5f5f5; font-weight:bold">Accessories</h5>
            <ul>
              @foreach($accessories as $accessory)
              <li> {{$accessory->color}} {{$accessory->type_name}}</li>
              @endforeach
            </ul>
          @if(count($designs)>0)
          <h5 style="background: #f5f5f5; font-weight:bold">Design</h5>
            <ul>
              @foreach($designs as $design)
              <li> {{$design->type_name}} - {{$design->actual_size}} - {{$design->location}}</li>
              @endforeach
            </ul>
          @endif
        </div>
        <div class="col-sm-12 form-group">
          <label>Total Product Cost</label>
          <p style="color: green; font-weight:bold"> Php {{$product->total_price}}</p>
          
        </div>    
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <a type="button" class="btn btn-default" href="{{url('/products')}}">Back to List</a>
      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /.box box-primary -->
  </div>
  <!-- /.col -->
  <div class="col-md-3">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Options</h3>
        </div>
        <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-sm-12">
                <a type="button" class="btn btn-success btn-block" href="{{ url('./products')}}/{{$product->id}}/edit"><i class="fa fa-edit"></i> Edit</a>
                <a type="button" class="btn btn-success btn-block" href="{{ url('./products')}}/{{$product->id}}/delete"><i class="fa fa-trash-o"></i> Delete</a>
                <a type="button" class="btn btn-success btn-block">Print</a>
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
      <!-- /.box box-success -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection

@push('extra_scripts')
<script>

$(document).ready(function(){
  //Initialize Today's date
  var date = parse_date($('#date_form').val());
  $('#date').text(date.text);
});

</script>
@endpush