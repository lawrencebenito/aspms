<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Apparel SPMS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset("/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset("/bower_components/font-awesome/css/font-awesome.min.css")}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset("/bower_components/Ionicons/css/ionicons.min.css")}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset("/bower_components/morris.js/morris.css")}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset("/bower_components/jvectormap/jquery-jvectormap.css")}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset("/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset("/bower_components/bootstrap-daterangepicker/daterangepicker.css")}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset("/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}}">
  <!-- Favicon -->
  @include('includes.favicon')
  @stack('extra_links')
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("/dist/css/AdminLTE.css")}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset("/dist/css/skin-red.css")}}">
  
</head>

<body class="fixed hold-transition skin-red sidebar-mini">
<div class="wrapper">

  @include('includes.header')
  @include('includes.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('page_header')
      </h1>
      @yield('breadcrumb')
    </section>
    <!-- Main content -->
    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- /.wrapper -->
</body>

<!-- jQuery 3 -->
<script src="{{ asset("/bower_components/jquery/dist/jquery.min.js")}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset("/bower_components/jquery-ui/jquery-ui.min.js")}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset("/bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script>
<!-- Morris.js charts -->
<script src="{{ asset("/bower_components/raphael/raphael.min.js")}}"></script>
<script src="{{ asset("/bower_components/morris.js/morris.min.js")}}"></script>
<!-- Sparkline -->
<script src="{{ asset("/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js")}}"></script>
<!-- jvectormap -->
<script src="{{ asset("/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js")}}"></script>
<script src="{{ asset("/plugins/jvectormap/jquery-jvectormap-world-mill-en.js")}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset("/bower_components/jquery-knob/dist/jquery.knob.min.js")}}"></script>
<!-- daterangepicker -->
<script src="{{ asset("/bower_components/moment/min/moment.min.js")}}"></script>
<script src="{{ asset("/bower_components/bootstrap-daterangepicker/daterangepicker.js")}}"></script>
<!-- datepicker -->
<script src="{{ asset("/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset("/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")}}"></script>
<!-- Slimscroll -->
<script src="{{ asset("/bower_components/jquery-slimscroll/jquery.slimscroll.min.js")}}"></script>
<!-- FastClick -->
<script src="{{ asset("/bower_components/fastclick/lib/fastclick.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("/dist/js/adminlte.min.js")}}"></script>

<!--!!! Custom Scripts !!!-->
<!-- Toggle Forms -->
<script src="{{ asset("/dist/js/toggle-forms.js")}}"></script>
<!-- Set Active Class -->
<script src="{{ asset("/dist/js/set-active.js")}}"></script>
<!-- Custom Scripts for global function-->
<script src="{{ asset("/dist/js/helper-functions.js")}}"></script>

@stack('extra_scripts')

</html>