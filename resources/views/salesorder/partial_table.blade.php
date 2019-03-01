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
    <td>{{$company_name}}</td>
    <td>{{$value->salesStatus}}</td>
    <td>{{$value->releaseStatus}}</td>
    <td style="text-align: center;">
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