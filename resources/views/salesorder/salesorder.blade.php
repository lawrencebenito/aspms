@extends('layouts.main')

@push('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
@endpush

@section('page_header')
  @include('orders.header')
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Sales</a></li>
    <li class="active">All Sales Orders</li>
  </ol>
@endsection

@section('content')

<div class="row">
  <div class="col-md-12">
    <h1>All Sales Orders</h1>
  </div>
</div>

<div class="row">
  <div class="table table-responsive sales-table col-md-11">
    <table class="table table-bordered" id="table">
      <tr bgcolor="yellow">
        <th width="150px">Sales No.</th>
        <th width="150px">Customer Account</th>
        <th>Customer Name</th>
        <th>Sales Status</th>
        <th>Payment Status</th>
        <th class="text-center" width="150px">
          <a class="create-modal btn btn-success btn-sm">
            <i class="glyphicon glyphicon-plus"></i>
          </a>
        </th>
      </tr>
      @foreach ($sales_orders as $key =>$value)
      <tr class="">
        <td>{{$value->salesID}}</td>
        <td>{{$value->client_id}}</td>
        <td>
          @foreach($clients as $client)
            @if($client->id == $value->client_id)
              {{$client->company_name}}
            @endif
          @endforeach
        </td>
        <td>{{$value->salesStatus}}</td>
        <td>{{$value->releaseStatus}}</td>
        <td>
          <a href="#" class="show-modal btn btn-sm btn-info" data-id="{{$value->salesID}}" onclick="viewSalesOrder('{{$value->salesID}}')">
            <i class="fa fa-eye"></i> View
          </a>
          <a href="#" class="delete-modal btn btn-danger btn-sm" data-id="{{ $value->salesID }}">
            <i class="glyphicon glyphicon-trash"></i>
          </a>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
{{$sales_orders->links()}}
</div>
<!-- new sales order -->
<div id="create" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body" id="create-modal-body">
        
      </div>
    </div>
  </div>
</div>

<!-- salesline modal-->
<div id="salesline" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body" id="salesline-modal-body">
        
      </div>
    </div>
  </div>
</div>


@endsection

@push('extra_scripts')
<script type="text/javascript">

  var rowCtr = 0;
  var globalProdID;
  var globalTotalPrice = 0;
  $(document).on('click','.create-modal', function(){
    
    $.ajaxSetup({
     headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }); 
    $.ajax({
      type : 'get',
      url : '/SalesOrders/new',
      data : {},
      success : function(data){
        $('#create-modal-body').html(data);
        $('#create').modal('show');
        $('.form-horizontal').show();
        $('.modal-title').text('New Sales Order');
      }
    });
  });

  function create(){

    var custaccount = $('#custaccount').val();
    var salesID = $('input[name = salesid]').val();
    var deliveryDate = $('#deliveryDate').val();
    
    if(custaccount == null)
    {
      jQuery('.alert-danger').show();
      jQuery('.alert-danger').append('<p>'+'Select Product Number.' +'</p>');
    }
   
    if(deliveryDate == '')
    {
      jQuery('.alert-danger').show();
      jQuery('.alert-danger').append('<p>'+'Delivery Date is required.' +'</p>');
    }
    else
    {
      $.ajax({
        url : "SalesOrders/create",
        method : 'get',
        data : {
          'custaccount' : custaccount,
          'salesID' : salesID,
          'deliveryDate' : deliveryDate
        },
        success : function(data){
          if(data != "")
          {
            $('#create').modal('hide');
            swal({
              title: "Success!",
              text: "New Sales order has been created",
              icon: "success",
              buttons: true,
            })
            .then((willDelete) => {

              $.ajax({
                type : 'get',
                url : '/SalesLine',
                data : {
                  'salesID' : salesID,
                  'reqData' : 'create'
                },
                success : function(data){
                  $('#salesline-modal-body').html(data);
                  $('.modal-title').text('Sales line');
                  $('#salesline').modal('show');
                }
              });
            });
            $('.sales-table').html('');
            $('.sales-table').html(data);
          }
          else
          {
            swal({
              title: "Oooopss!!",
              text: "Error saving.",
              icon: "error",
              buttons: true,
              dangerMode: true,
            })
          }
        }
      });
    }
  }

  function addRow()
  {
    $.ajax({
      type : 'get',
      url : '/SalesLine/addRow',
      data : {
            'reqData':'addRow',
            'ctr' : rowCtr
            },
      success : function(data){
        $('#salesline-table-body').append(
          '<tr id="'+rowCtr+'">'
            + '<td>'+data+ '</td>'
            + '<td id="productName' +rowCtr+'" class="productName">'+' '+ '</td>'
            + '<td id ="productPrice'+rowCtr+'" class="productPrice">'+' '+ '</td>'
            + '<td >'+' <input type="number" class="form-control productQty" id="productQty' +rowCtr+ '" name="quantity" onchange="getNetAmount(this.value,'+rowCtr+')" required> '+ '</td>'
            + '<td id="productNetAmount'+rowCtr+'" class="productNetAmount">'+' '+ '</td>'
            + '<td>'+' <button type="button" class="btn btn-danger" onclick="func_remove('+rowCtr+')"><i class="fa fa-times"></i></button></td> '
            +
          '</tr>'
          );
        rowCtr++;
      }
    });
  }

  function getProductDetails(_productID, ctr)
  {
    var productID = _productID;
    globalProdID = _productID;
    $.ajax({
      type : 'get',
      url : '/SalesLine/addRow',
      data : {
        'reqData' : 'getProductDetails',
        'productID' : productID
      },
      success : function(data){
        globalTotalPrice = data[0].total_price;
        $('#productQty'+ctr).val('');
        $('#productNetAmount'+ctr).html('');
        $('#productName'+ctr).html(data[0].description);
        $('#productPrice'+ctr).html(data[0].total_price);
      }
    });

  }

  // Show function
  function viewSalesOrder(_salesID)
  {
    var salesID = _salesID;
   
    $.ajax({
      type : 'get',
      url : '/SalesLine',
      data : {
        'salesID' : salesID,
        'reqData' : 'view'
      },
      success : function(data){
        $('#salesline-modal-body').html(data);
        $('.modal-title').text('Sales line');
        $('#salesline').modal('show');
      }
    });
  }

  function getNetAmount(_quantity,ctr)
  {
    var quantity = _quantity;
    var netAmount = quantity * globalTotalPrice;
    $('#productNetAmount'+ctr).html(netAmount);
  }
  function func_remove(id){
    $('#'+id).remove();
  }

  function saveLine(_salesID)
  {
    var allProdID = [];
    var allQuantity = [];
    var salesID = _salesID;
    var hasErrors = 0;
    var hasRecords = 0;
    
    $.each($(".productID"), function(){
        hasRecords = 1;
        if($(this).val() == null)
        {
          hasErrors = 1;

          jQuery('.alert-danger').show();
          jQuery('.alert-danger').append('<p>'+'Select Product Number.' +'</p>')
        }
        allProdID.push($(this).val());
    });
    $.each($(".productQty"), function(){
      hasRecords = 1;
      if($(this).val() == "")
        {
          hasErrors = 1;

          jQuery('.alert-danger').show();
          jQuery('.alert-danger').append('<p>'+'Quantity is required.' +'</p>')
        }
        allQuantity.push($(this).val());
    });
    if(hasRecords == 0)
    {   
          $('.alert-danger').show();
          $('.alert-danger').append('<p>'+'Please add records.' +'</p>')
    }
    if(hasErrors == 0 && hasRecords == 1)
    {
      $.ajax({
        type : 'get',
        url : '/SalesLine/save',
        data : {
          'salesID' : salesID,
          'allProdID' : allProdID,
          'allQuantity' : allQuantity
        },
        success : function(data){
          if(data == 0)
          {
            swal({
              title: "Success!",
              text: "Record successfully saved.",
              icon: "success",
              buttons: true,
            })

            $('#salesline').modal('hide');
          }
          else
          {
            swal({
              title: "Oooopss!!",
              text: "Error saving.",
              icon: "error",
              buttons: true,
              dangerMode: true,
            });
          }
        }
      });
    }
  }

  function editSalesLines(salesID)
  {
    var allRows = [];
    var ctr = 0;
    var prodID;
    
    $('#editBtn').addClass('disabled');
    $('#confirmBtn').addClass('disabled');
    $('#invoiceBtn').addClass('disabled');

    $('#tableheader').append('<th class="text-center"></th');
    $.each($(".linerow"), function(){
        $('#row'+ctr).append('<td><button type="button" class="btn btn-danger" onclick="func_remove('+'\'row'+ctr+'\')"><i class="fa fa-times"></i></button></td>');

        prodID = $('#td'+ctr).attr('data-id');
        $('#productQty'+ctr).prop('disabled',false);
        getShit(ctr, prodID); //ipasa yung prodID
        ctr++;
    });
    

    $('.modal-footer').html('');
    $('.modal-footer').append('<button class="btn btn-info" type="button" onclick="updateLines(\''+salesID+'\')">'+
     'Save'+'</button>' //+
    // '<button class="btn btn-warning" type="button" data-dismiss="modal">'+
    //   '<span class="glyphicon glyphicon-remove"></span> Close'+
    // '</button>'
    );
  }

  function getShit(ctr,prodID){
    $.ajax({
      type : 'get',
      url : '/SalesLine/addRow',
      data : {
            'reqData':'addRow',
            'ctr' : ctr,
            'prodID' : prodID
            },
      success : function(data){
        $('#td'+ctr).html(data);
      }
    });
  }

  function updateLines(salesID)
  {
    var allQuantity = [];
    var allRecID = [];
    var allProdID = [];
    var hasRecords = 0;
    var hasErrors = 0;

    $.each($(".productID"), function(){
        hasRecords = 1;
        if($(this).val() == null)
        {
          hasErrors = 1;

          jQuery('.alert-danger').show();
          jQuery('.alert-danger').append('<p>'+'Select Product Number.' +'</p>')
        }
        allProdID.push($(this).val());
    });
    $.each($(".salesline-recid"), function(){
        allRecID.push($(this).attr('data-recid'));
    });
    $.each($(".productQty"), function(){
      hasRecords = 1;
      if($(this).val() == "")
        {
          hasErrors = 1;

          jQuery('.alert-danger').show();
          jQuery('.alert-danger').append('<p>'+'Quantity is required.' +'</p>')
        }
        allQuantity.push($(this).val());
    });
    if(hasRecords == 0)
    {   
          $('.alert-danger').show();
          $('.alert-danger').append('<p>'+'Please add records.' +'</p>')
    }
    if(hasErrors == 0 && hasRecords == 1)
    {
      $.ajax({
        type : 'get',
        url : '/SalesLine/update',
        data : {
              'allQuantity':allQuantity,
              'allRecID' : allRecID,
              'allProdID' : allProdID,
              'salesID' : salesID
              },
        success : function(data){
          if(data == 0)
          {
            $('#editBtn').prop('disabled',false);
            swal({
              title: "Success!",
              text: "Records updated.",
              icon: "success",
              buttons: true,
            })

            $('#salesline').modal('hide');
          }
        }
      });
    }
  }

  function confirmSO(_salesID)
  {
    $.ajax({
      type : 'get',
      url : '/SalesOrders/confirm',
      data : {
              'salesID':_salesID
            },
      success : function(data){
        if(data==0)
        {
          $('#confirmBtn').addClass('hidden');
          swal({
            title: "Success!",
            text: "Sales order delivered.",
            icon: "success",
            button: 'Ok',
          })
          .then((value) => {
            if (value) {
              $('#salesline').modal('hide');
            } 
          });
        }
      }
    });
  }

  function invoiceSO(_salesID)
    {
      $.ajaxSetup({
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
       });

      $.ajax({
        type : 'post',
        url : '/SalesOrders/invoice',
        data : {
                'salesID':_salesID,
                'token' : $('input[name = _token]').val()
              },
        success : function(data){
          if(data==0)
          {
            $('#confirmBtn').addClass('hidden');
            swal({
              title: "Success!",
              text: "Sales order invoiced.",
              icon: "success",
              button: 'Ok',
            })
            .then((value) => {
              if (value) {
                $('#salesline').modal('hide');
              } 
            });
          }
        }
      });
    }
</script>
@endpush