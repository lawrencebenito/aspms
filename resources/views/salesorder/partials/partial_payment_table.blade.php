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
        <i class="fa fa-eye"></i> print OR
      </a>
      @endif
      <a href="#" class="delete-modal btn btn-danger btn-sm" onclick="delete_payment('{{$payment->payment_no}}')">
        <i class="glyphicon glyphicon-trash"></i>
      </a>
    </td>
  </tr>
  @endforeach