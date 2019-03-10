@extends('layouts.main')

@push('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
@endpush

@section('page_header')
  <i class="fa fa-shopping-cart"></i> Customer Payments
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Sales</a></li>
    <li class="active">Payments</li>
  </ol>
@endsection

@section('content')

<div class="container-fluid">
  <div class="table table-responsive sales-table col-md-11">
    <table id="data_table" class="table table-bordered table-hover" id="table" data-toggle='tooltip' width="100%">
      <thead>
        <tr bgcolor="yellow">
          <th width="150px">Payment No.</th>
          <th width="150px">Customer Account</th>
          <th>Customer Name</th>
          <th>Payment Status</th>
          <th class="text-center" width="220px">
            <button class="create-modal btn btn-success btn-sm" onclick="create_payment_modal()">
              <i class="glyphicon glyphicon-plus"></i>
            </button>
          </th>
        </tr>
      </thead>
      <tbody id="payment-table-body">
      @foreach($cust_payments as $payment)
      <tr>
        <td>{{$payment->payment_no}}</td>
        <td>{{$payment->client_id}}</td>
        
        @foreach($clients as $client)
          @if($client->id == $payment->client_id)
            <td>{{$client->company_name}}</td>
          @endif
        @endforeach
        
        <td>{{$payment->payment_status}}</td>
        <td style="text-align: center;">
          <a href="#" class="show-modal btn btn-sm btn-info" onclick="view_payment('{{$payment->payment_no}}')">
            <i class="fa fa-eye"></i> View
          </a>
          @if($payment->payment_status == "Settled")
            <a href="/SalesOrder/payment/printOR/{{$payment->payment_no}}" class="show-modal btn btn-sm btn-success">
             print OR
          </a>
          @endif
          <a href="#" class="delete-modal btn btn-danger btn-sm" onclick="delete_payment('{{$payment->payment_no}}')">
            <i class="glyphicon glyphicon-trash"></i>
          </a>
        </td>
      </tr>
      @endforeach
      </tbody>
    </table>
  </div>
  {{$cust_payments->links()}}
</div>

<div class="modal fade" id="create_payment" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="paymentlines">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

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
<script src="{{ asset("bower_components/datatables.net/js/jquery.dataTables.min.js")}}"></script>
<script src="{{ asset("bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>
<script type="text/javascript">
   $('#table').DataTable( );
   $.ajaxSetup({
     headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }); 
  function create_payment_modal()
  {
    $.ajax({
      type : 'get',
      url : '/SalesOrder/payment/create',
      data : {},
      success : function(data){
        $('.modal-body').html(data);
        $('#create_payment').modal('show');
        $('.form-horizontal').show();
        $('.modal-title').text('New Payment');
      }
    });
  }

  function save_payment(payment_no)
  {
    var salesID_arry = [];
      $.each($(".radioBtn"), function(){
        if($(this).prop("checked") == true)
        {
          salesID_arry.push($(this).val());
        }
     });

    $.ajax({
      type : 'post',
      url : '/SalesOrder/payment/save',
      data : {
        'payment_no' : payment_no,
        'client_id' : $('#custaccount').val(),
        'payment_mode' : $('#paymentMode').val(),
        'payment_type' : 'Full',
        'payment_amount' : $('#paymentamount').val(),
        'allSalesID' : salesID_arry
      },
      success : function(data){
        $('#payment-table-body').html('');
        $('#payment-table-body').html(data);
        swal({
            title: "Success!",
            text: "Payment settled.",
            icon: "success",
            button: 'Ok',
          })
          .then((value) => {
            if (value) {
              $('#create_payment').modal('hide');
            } 
          });
      }
    });
  }

  function view_payment(payment_no)
    {
      $.ajax({
        type : 'get',
        url : '/SalesOrder/payment/view',
        data : {
          'payment_no' :payment_no
        },
        success : function(data){
          $('#salesline-modal-body').html(data);
          $('#salesline').modal('show');
          $('.form-horizontal').show();
          $('.modal-title').text('Payment Details');
        }
      });
    }

    function settle_payment(payment_no)
    {
      var salesID_arry = [];
      $.each($(".radioBtn"), function(){
        if($(this).prop("checked") == true)
        {
          salesID_arry.push($(this).val());
        }
     });
      $.ajax({
        type : 'post',
        url : '/SalesOrder/payment/settle',
        data : {
          'payment_no' :payment_no,
          'allSalesID' : salesID_arry
        },
        success : function(data){
          if(data == 0)
          {
            swal({
              title: "Success!",
              text: "Payment settled.",
              icon: "success",
              button: 'Ok',
            })
            .then((value) => {
              if (value) {
                $('#salesline').modal('hide');
                // window.location.reload();
              } 
            });
          }
        }
      });
    }

    function get_client_orders(clientid)
    {
      $.ajax({
        type : 'get',
        url : '/SalesOrder/payment/clientorders',
        data : {
          'clientid' :clientid
        },
        success : function(data){
           $('#clientorders-table').html('');
          $('#clientorders-table').html(data);
        }
      });
    }

    function delete_payment(payment_no)
    {
      swal({
          title: "Warning!!",
          text: "Are you sure you want to delete?",
          icon: "warning",
          button: 'Ok',
        })
        .then((value) => {
          $.ajax({
            type : 'get',
            url : '/SalesOrder/payment/delete/',
            data : {
              'payment_no' :payment_no,
              'token' : $('input[name = _token]').val()
            },
            success : function(data){
              $('#payment-table-body').html('');
              $('#payment-table-body').html(data);
               if(data == 0)
               {
                  swal({
                    title: "Deleted!!!",
                    text: "Payment deleted.",
                    icon: "warning",
                    button: 'Ok',
                  })
                  .then((value) => {
        
                  });
               } // if
            }
          });
        });
    }
</script>
@endpush