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
    <span class="brand-text font-weight-light">Poliklinik Udinus</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

      <div class="info">
        <a class="d-block"><?php echo $nama; ?></a>
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
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Menampilkan menu khusus admin -->
        <li class="nav-item">
          <a href="../home/dashboard.php" class="nav-link ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../admin/home_dokter.php" class="nav-link">
            <i class="nav-icon fas fa-user-md"></i>
            <p>
              Dokter
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-injured"></i>
            <p>
              Pasien
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../admin/home_pasien.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Pasien</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pendaftaran Poli Pasien</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pemeriksaan Poli Pasien</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Detail Periksa Pasien</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="../admin/home_poli.php" class="nav-link">
            <i class="nav-icon fas fas fa-clinic-medical"></i>
            <p>
              Poli Klinik
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../admin/home_obat.php" class="nav-link">
            <i class="nav-icon fas fa-capsules"></i>
            <p>
              Obat
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
        <!-- ... Menu lainnya untuk admin ... -->
      </ul>
    </nav>
  </div <!-- /.sidebar-menu -->
</aside>