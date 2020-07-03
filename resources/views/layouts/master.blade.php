<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Homelessness Visualization</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/AdminLTE-3.0.0/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/AdminLTE-3.0.0/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  @yield('stylesheets')

  <script>
  (function(h,e,a,t,m,p) {
  m=e.createElement(a);m.async=!0;m.src=t;
  p=e.getElementsByTagName(a)[0];p.parentNode.insertBefore(m,p);
  })(window,document,'script','https://u.heatmap.it/log.js');
  </script>

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper" >

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-left: 0">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="/logout">Logout</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->


    <div class="row">
      @include('flash::message')
    </div>

    <!-- Main content -->

     @yield('content')

  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <a href="/logout">Logout</a>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer" style="margin-left: 0">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      DATALab
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018-2021 <a href="https://www.datalab.science/">datalab.science</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/AdminLTE-3.0.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/AdminLTE-3.0.0/dist/js/adminlte.min.js"></script>
@yield('scripts')
</body>
</html>
