@php
  $netAmount = 0;
  $amountToBePaid = 0;
@endphp
 @foreach($orders as $order)
  @foreach($deliveries as $delivery)
    @if($delivery->salesID == $order->id)

    @foreach($orderlines as $line)
      @if($line->order == $order->id)
        @foreach($products as $product)
          @if($product->id == $line->product)
            @php
              $netAmount = $netAmount + ($line->quantity * $product->total_price);
            @endphp
          @endif
        @endforeach
      @endif
    @endforeach
      <tr>
        <td>
          <div class="radio radio-info">
            <input type="checkbox" id="radio{{ $order->id }}" class="radioBtn" name="allorders" value="{{ $order->id }}">
          </div>
        </td>
        <td><a href="/orders/{{$order->id}}">{{$order->id}}</a></td>
        <td>{{$order->date_created}}</td>
        <td>{{$delivery->deliveryID}}</td>
        <td>{{$delivery->created_at}}</td>
        <td style="text-align: right">{{$netAmount}}</td>
      </tr>
      @php
        $amountToBePaid = $amountToBePaid + $netAmount;
        $netAmount = 0;
      @endphp
    @endif
  @endforeach
 @endforeach
 <tr>
   <td><b>Total:</b></td>
   <td></td>
   <td></td>
   <td></td>
   <td></td>
   <td style="text-align: right"><b>{{$amountToBePaid}}</b></td>
 </tr>