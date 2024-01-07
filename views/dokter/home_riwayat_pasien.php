<?php
session_start();

// Mendapatkan role dari session atau dari tempat lain sesuai kebutuhan
if (isset($_SESSION['role_id'])) {
  $role = $_SESSION['role_id'];

  // Tentukan file sidebar yang akan dimuat berdasarkan role
  if ($role === 1) {
    $sidebar_file = '../../components/sidebar_admin.php';
  } elseif ($role === 2) {
    $sidebar_file = '../../components/sidebar_dokter.php';
  } else {
    // Atur default jika $_SESSION['role_id'] tidak terdefinisi atau tidak sesuai
    $sidebar_file = '../../components/sidebar_pasien.php';
  }
} else {
  // Atur default jika $_SESSION['role_id'] belum terdefinisi
  $sidebar_file = '../../components/sidebar_pasien.php';
}
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poliklinik BK | Dashboard Dokter</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <!-- <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css"> -->
  <link rel="stylesheet" href="../../helper/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../helper/AdminLTE/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <?php
    include('../../components/navbar.php');
    ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include($sidebar_file); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <?php
      include('../../pages/riwayat/riwayat_pasien.php');
      ?>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?php
    include('../../components/footer.php');
    ?>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="../../helper/AdminLTE/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../helper/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../helper/AdminLTE/dist/js/adminlte.min.js"></script>
</body>

</html>