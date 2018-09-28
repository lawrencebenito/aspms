<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class={{ Helper::is_active('home') }}>
        <a href="{{ route('home')}}">
          <i class="fa fa-home"></i> <span>Dashboard</span>
        </a>
      </li>
      <!-- Maintenance -->
      <li class="treeview {{ Helper::is_active(['clients','workers','fabrics']) }}">
        <a href="#">
          <i class="fa fa-gears"></i> <span>Maintenance</span>
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Helper::is_active('clients') }}">
            <a href="{{ route('clients.index') }}">
            <i class="fa fa-user"></i> <span> Clients </span></a>
          </li>
          <li class="{{ Helper::is_active('workers') }}">
            <a href="{{ route('workers.index') }}">
            <i class="fa fa-users"></i> <span> Workers </span></a>
          </li>
          <li class="{{ Helper::is_active('fabrics') }}">
            <a href="{{ route('fabrics.index') }}">
            <i class="ion ion-scissors"></i> <span> Fabrics </span></a>
          </li>
          <li class="{{ Helper::is_active('garments') }}">
            <a href="{{ url('/garments_and_fabrics') }}">
            <i class="ion ion-tshirt"></i> <span> Garments </span></a>
          </li>
          <li>
            <a href="{{ url('/garments_and_fabrics') }}">
            <i class="ion ion-ios-pricetags"></i> <span> Accessories </span></a>
          </li>
          <li>
            <a href="{{ url('/operations_and_status') }}">
            <i class="ion ion-android-star"></i> <span> Design </span></a>
          </li>
        </ul>
      </li>
      <!-- Sales -->
      <li class="treeview {{ Helper::is_active(['products','quotations','orders']) }}">
        <a href="#">
          <i class="fa fa-line-chart"></i> <span>Sales</span>
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
          <li> 
            <a href="{{ url('/products') }}">
            <i class="ion ion-tshirt"></i> <span>Products</span></a>
          </li>
          <li class="{{ Helper::is_active('quotations') }}">
            <a href="{{ route('quotations.index') }}">
            <i class="fa fa-sticky-note"></i> <span>Quotations</span></a>
          </li>
          <li class="{{ Helper::is_active('orders') }}">
            <a href="{{ route('orders.index') }}">
            <i class="fa fa-shopping-cart"></i> <span>Orders</span></a>
          </li>
        </ul>
      </li>
      <!-- Production -->
      <li class="treeview {{ Helper::is_active(['job_orders','production_log']) }}">
        <a href="#">
          <i class="glyphicon glyphicon-scissors"></i> <span>Production</span>
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">          
          <li>
            <a href="#">
            <i class="fa fa-list-ol"></i> <span>Job Orders</span></a>
          </li>
          <li>
            <a href="#">
            <i class="glyphicon glyphicon-list-alt"></i> <span>Production Log</span></a>
          </li>
        </ul>
      </li>
      <!-- Reports -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-area-chart"></i> <span>Reports</span>
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="#">
            <i class="glyphicon glyphicon-stats"></i> <span>Sales Report</span></a>
          </li>
          <li>
            <a href="#">
            <i class="glyphicon glyphicon-tasks"></i> <span>Production Report</span></a>
          </li>
        </ul>
      </li>
    </ul>
    <!-- /.sibar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>