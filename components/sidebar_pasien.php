<?php

if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
}

$user_id = $_SESSION['user_id'];
$role_id = $_SESSION['role_id'];
$nama = $_SESSION['nama']; // Ambil nama dari session


// ... (Lanjutkan dengan konten halaman sesuai kebutuhan)
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="dashboard.php" class="brand-link">
    <img src="../../config/img/logo_dinus.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light text-center">Poliklinik Udinus</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

      <div class="info">
        <a class="d-block"><?php echo $nama ?></a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>
    <!-- ... Header Brand, User Panel, SidebarSearch Form, etc. ... -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Menampilkan menu khusus dokter -->
        <li class="nav-item">
          <a href="../home/dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-house-user"></i>
            <p>Dashboard</p>
            <span class="right badge badge-success">Pasien</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="../pasien/home_poli_pasien.php" class="nav-link">
            <i class="nav-icon fas fa-clinic-medical"></i>
            <p>Poli</p>
            <span class="right badge badge-success">Pasien</span>
          </a>
        </li>
        <!-- ... Menu lainnya untuk dokter ... -->
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
</aside>