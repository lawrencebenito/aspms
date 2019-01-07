@extends('layouts.main')

@section('page_header')
  @include('quotations.header')
@endsection

@section('content')

@if (session()->has('edited_quotation'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Editing Successful!</h4>
    Changes made for this quotation: {{ session()->get('edited_quotation') }}.
  </div>
@endif

<div class="row">
  <div class="col-md-9">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">View Quotation</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="form-group col-lg-2">
            <label>Date</label>
            <p id="date"></p>
            <input id="date_form" type="hidden" class="form-control" name="date_created" value="{{$quotation->date_created}}">
          </div>
          <div class="form-group col-lg-3">
            <label>Client Name</label>
            <p>{{$quotation->full_name}}</p>
          </div>
          @if (!is_null($quotation->company_name))
            <div class="form-group col-lg-3" id="company_group">
              <label>Company Name</label>
              <p>{{$quotation->company_name}}</p>
            </div>
          @endif
          @if (!is_null($quotation->company_name))
            <div class="form-group col-lg-3" id="address_group">
              <label>Client Address</label>
              <p>{{$quotation->address}}</p>
            </div>
          @endif
        </div>
        <div class="form-group"  width="75%">
          <div id="myTable" class="table-responsive">
            <table class="table table-bordered">
              <tr bgcolor="#f5f5f5">
                <th style="width: 20%">Product Description</th>
                <th style="width: 25%">Unit Price</th>
              </tr>
              @foreach($products as $key => $product)
                @if($key == 0 || ($key > 0 && $products[$key]->garment != $products[$key-1]->garment))
                  <tr>
                    <td style="font-weight:bold">{{$product->garment}}</td>
                    <td></td>
                  </tr>  
                @endif
                <tr>
                  <td>{{$product->fabric}}</td>
                  <td>{{$product->unit_price}}</td>
                </tr>
                @if(($key == count($products)-1 || ($key < count($products)-1 && $products[$key]->garment != $products[$key+1]->garment)) && !is_null($product->description))
                  <tr><td colspan="2">{{$product->description}}</td></tr>
                @endif
              @endforeach
            </table>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <a type="button" class="btn btn-default" href="{{url('/quotations')}}">Back to List</a>
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
                <a type="button" class="btn btn-success btn-block" href="{{ url('./quotations')}}/{{$quotation->id}}/edit"><i class="fa fa-edit"></i> Edit</a>
                <a type="button" class="btn btn-success btn-block" href="{{ url('./quotations')}}/{{$quotation->id}}/delete"><i class="fa fa-trash-o"></i> Delete</a>
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