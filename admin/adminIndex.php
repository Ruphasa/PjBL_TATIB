<?php
include('../lib/Session.php');
$session = new Session();
if ($session->get('is_login') !== true) {
  header('Location: ../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Blank Page</title>

  <!-- DataTables -->
  <link rel="stylesheet" href="../adminLTE/plugins/datatablesbs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../adminLTE/plugins/datatablesresponsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../adminLTE/plugins/datatablesbuttons/css/buttons.bootstrap4.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../adminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../adminLTE/dist/css/adminlte.min.css">
  <!-- bootstrap icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- jQuery -->
  <script src="../adminLTE/plugins/jquery/jquery.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <?php include('../layouts/header.php'); ?>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../adminLTE/index3.html" class="brand-link">
        <img src="../adminLTE/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <?php include('../layouts/sidebar.php'); ?>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <?php
      $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
      switch (strtolower($page)) {
        case 'dashboard':
          include('../pages/dashboard.php');
          break;
        case 'buku':
          include('pages/buku.php');
          break;
        case 'kategori':
          include('pages/kategori.php');
          break;
        case 'user':
          include('pages/user.php');
          break;
      }
      ?>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include('layouts/footer.php'); ?>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->


  <!-- Bootstrap 4 -->
  <script src="../adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery Validation -->
  <script src="../adminLTE/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="../adminLTE/plugins/jquery-validation/additional-methods.min.js"></script>
  <script src="../adminLTE/plugins/jquery-validation/localization/messages_id.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../adminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../adminLTE/plugins/datatablesresponsive/js/dataTables.responsive.min.js"></script>
  <script src="../adminLTE/plugins/datatablesresponsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../adminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../adminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../adminLTE/plugins/jszip/jszip.min.js"></script>
  <script src="../adminLTE/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../adminLTE/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../adminLTE/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../adminLTE/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../adminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../adminLTE/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../adminLTE/dist/js/demo.js"></script>
</body>

</html>