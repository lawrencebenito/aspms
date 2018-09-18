@extends('layouts.main')

@section('extra_links')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}">
@endsection

@section('page_header')
  <i class="fa fa-list-ol"></i> Job Orders
@endsection

@section('content')
<div class="box box-solid box-warning source">
    <div class="box-header">
      <h3 class="box-title">List of Current Job Orders of Clients</h3>      
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
      <table class="table table-hover">
        <tbody><tr>
          <th style="width: 80px">Order #</th>
          <th>Client Name</th>
          <th>Quantity Order</th>
          <th>Progress</th>
          <th style="width: 60px"> </th>
          <th>Due Date</th>
          <th>Remaining Days</th>
        </tr>
        <tr>
          <td>ORD20180001</td>
          <td>John Doe</td>
          <td>1,000 pcs.</td>
          <td>
            <div class="progress progress-xs">
              <div class="progress-bar progress-bar-yellow" style="width: 55%"></div>
            </div>
          </td>
          <td><span class="badge bg-yellow">55%</span></td>
          <td>04-06-2018</td>
          <td>9 days</td>
        </tr>
        <tr>
          <td>ORD20180002</td>
          <td>Alexander Pierce</td>
          <td>3,000 pcs.</td>
          <td>
            <div class="progress progress-xs">
              <div class="progress-bar progress-bar-info" style="width: 70%"></div>
            </div>
          </td>
          <td><span class="badge bg-light-blue">70%</span></td>
          <td>04-01-2018</td>
          <td>5 days</td>
        </tr>
        <tr>
          <td>ORD20180003</td>
          <td>Mike Doe</td>
          <td>5,000 pcs.</td>
          <td>
            <div class="progress progress-xs">
              <div class="progress-bar progress-bar-danger" style="width: 30%"></div>
            </div>
          </td>
          <td><span class="badge bg-red">30%</span></td>
          <td>05-01-2018</td>
          <td>1 month, 4 days</td>
        </tr>
        <tr>
          <td>ORD20180004</td>
          <td>Zachary Wyman</td>
          <td>2,000 pcs.</td>
          <td>
            <div class="progress progress-xs">
              <div class="progress-bar progress-bar-success" style="width: 90%"></div>
            </div>
          </td>
          <td><span class="badge bg-green">90%</span></td>
          <td>03-28-2018</td>
          <td>1 day</td>
        </tr>
        <tfoot>
          
        </tfoot>
      </tbody></table>
    </div>
    <!-- /.box-body -->
  </div>
</div>
@endsection

@section('extra_scripts')
<!-- DataTables -->
<script src="{{ asset("bower_components/datatables.net/js/jquery.dataTables.min.js")}}"></script>
<script src="{{ asset("bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>

<script>
$(document).ready(function(){
    $(".show-add-form").click(function(){
        $(".source").fadeOut(500);
        $(".add-form").show(2000);
    });
    $(".show-add-form-wc").click(function(){
        $(".add-form").show(2000);
    });

    $(".close-add-form").click(function(){
        $(".add-form").slideUp(500);
        $(".source").slideDown(1500);
    });
} ); //end of document.ready

</script>
@endsection