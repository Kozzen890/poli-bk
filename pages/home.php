<?php
include './koneksi.php';

// Query untuk menghitung jumlah pasien
$query_jml_pasien = "SELECT COUNT(*) as jumlah_pasien FROM pasien";
$query_jml_dokter = "SELECT COUNT(*) as jumlah_dokter FROM dokter";
$query_jml_poli = "SELECT COUNT(*) as jumlah_poli FROM poli";
$query_jml_obat = "SELECT COUNT(*) as jumlah_obat FROM obat";

// Eksekusi query dan ambil hasilnya
$result_pasien = mysqli_query($mysqli, $query_jml_pasien);
$result_dokter = mysqli_query($mysqli, $query_jml_dokter);
$result_poli = mysqli_query($mysqli, $query_jml_poli);
$result_obat = mysqli_query($mysqli, $query_jml_obat);

// Cek apakah query berhasil dieksekusi
if ($result_pasien && $result_dokter && $result_poli && $result_obat) {
  // Ambil hasil query
  $row_pasien = mysqli_fetch_assoc($result_pasien);
  $row_dokter = mysqli_fetch_assoc($result_dokter);
  $row_poli = mysqli_fetch_assoc($result_poli);
  $row_obat = mysqli_fetch_assoc($result_obat);

  // Ambil nilai jumlah dari hasil query
  $jumlah_pasien = $row_pasien['jumlah_pasien'];
  $jumlah_dokter = $row_dokter['jumlah_dokter'];
  $jumlah_poli = $row_poli['jumlah_poli'];
  $jumlah_obat = $row_obat['jumlah_obat'];
} else {
  // Handle kesalahan jika query tidak berhasil
  $jumlah_pasien = "Error";
  $jumlah_dokter = "Error";
  $jumlah_poli = "Error";
  $jumlah_obat = "Error";
}

// Tutup koneksi
mysqli_close($mysqli);
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="dashboard.php?page=home">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?php echo $jumlah_pasien; ?></h3>

            <p>Jumlah Pasien</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="home_pasien.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?php echo $jumlah_dokter; ?><sup style="font-size: 20px"></sup></h3>

            <p>Total Dokter</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="home_dokter.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?php echo $jumlah_poli; ?></h3>

            <p>Total Poli</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="home_poli.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?php echo $jumlah_obat; ?></h3>

            <p>Total Jenis Obat</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="home_obat.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->

      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->