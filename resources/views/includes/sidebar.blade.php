<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li id="dashboard-link">
        <a href="{{ url('/')}}">
          <i class="fa fa-home"></i> <span>Dashboard</span>
        </a>
      </li>
      <!-- Sales -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-line-chart"></i> <span>Sales</span>
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
          <li class=""><a href="{{ url('/clients') }}"><i class="fa fa-user"></i> <span>Clients</span></a></li>
          <li><a href="{{ url('/quotations') }}"><i class="fa fa-sticky-note"></i> <span>Quotation</span></a></li>
          <li><a href="{{ url('/orders') }}"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a></li>
        </ul>
      </li>
      <!-- Production -->
      <li class="treeview">
        <a href="#">
          <i class="glyphicon glyphicon-scissors"></i> <span>Production</span>
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ url('/workers') }}"><i class="fa fa-users"></i> <span>Workers</span></a></li>
          <li><a href="{{ url('/job_orders') }}"><i class="fa fa-list-ol"></i> <span>Job Orders</span></a></li>
          <li><a href="#"><i class="glyphicon glyphicon-list-alt"></i> <span>Production Log</span></a></li>
        </ul>
      </li>
      <!-- Reports -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-area-chart"></i> <span>Reports</span>
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="glyphicon glyphicon-stats"></i> <span>Sales Report</span></a></li>
          <li><a href="#"><i class="glyphicon glyphicon-tasks"></i> <span>Production Report</span></a></li>
        </ul>
      </li>
      <!-- Maintenance -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-gears"></i> <span>Maintenance</span>
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ url('/garments_and_fabrics') }}"><i class="fa fa-circle-o"></i> <span> Garments & Fabrics </span></a></li>
          <li><a href="{{ url('/operations_and_status') }}"><i class="fa fa-circle-o"></i> <span> Operations & Status </span></a></li>
        </ul>
      </li>
    </ul>
    <!-- /.sibar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>