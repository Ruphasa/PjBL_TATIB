<?php
include('../lib/Session.php');
include('../lib/Connection.php');
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
  <title>Siakad</title>

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


  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #000;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #f4f4f4;
    }
  </style>
</head>

<body style="height:100%">
  <!-- Site wrapper -->
  <div class="wrapper" style="height:100%">
    <!-- Navbar -->
    <?php include('../layouts/header.php'); ?>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <!-- <a href="../adminLTE/index3.html" class="brand-link">
        <img src="" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"></span>
      </a> -->

      <!-- Sidebar -->
      <?php include('../layouts/sidebar.php'); ?>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content">
        <div class="container-fluid">
          <?php

          $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
          switch (strtolower($page)) {
            case 'dashboard':
              include('../pages/dashboard.php');
              break;
            case 'pending':
              include('../pages/pending.php');
              break;
            case 'verifikasi':
              include('../pages/verifikasi.php');
              break;
            case 'riwayat':
              include('../pages/riwayat.php');
              break;
          }
          ?>
          <?php include('../layouts/footer.php'); ?>
        </div>
      </section>
    </div><!-- /.content-wrapper -->
  </div><!-- ./wrapper -->

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