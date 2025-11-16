<!DOCTYPE html>
<html lang="en">


@include('Admin.sellerlayout.head')
<style>
  /* Make sidebar full height */
.main-sidebar {
    height: 100vh;           /* Full viewport height */
    position: fixed;         /* Fixed so it stays on scroll */
    top: 0;
    left: 0;
    overflow-y: auto;        /* Scroll inside sidebar if content overflows */
}

/* Adjust main content to not go under sidebar */
.content-wrapper {
    margin-left: 250px;      /* Width of sidebar */
}

/* Navbar full width adjustment */
.main-header {
    margin-left: 250px;      /* Push right of sidebar */
}

</style>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
 
        @include('Admin.sellerlayout.header')
 
            @yield(section: 'content')



    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('admin/assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('admin/assets/js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('admin/assets/plugins/chart.js/Chart.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin/assets/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('admin/assets/js/pages/dashboard3.js') }}"></script>
</body>
</html>
