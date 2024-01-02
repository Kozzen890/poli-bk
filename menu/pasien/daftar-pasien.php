<?php
session_start();
include_once("../../koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Mendapatkan nilai dari form
  $nama = $_POST["nama_lengkap"];
  $alamat = $_POST["alamat"];
  $no_ktp = $_POST["no_ktp"];
  $no_hp = $_POST["no_hp"];

  // Cek apakah pasien sudah terdaftar berdasarkan No KTP
  $query_check_pasien = "SELECT id, nama, no_rm FROM pasien WHERE no_ktp = '$no_ktp'";
  $result_check_pasien = mysqli_query($mysqli, $query_check_pasien);

  if (mysqli_num_rows($result_check_pasien) > 0) {
    $row = mysqli_fetch_assoc($result_check_pasien);

    if ($row['nama'] != $nama) {
      echo "<script>alert(`Nama pasien tidak sesuai dengan nomor KTP yang terdaftar.`);</script>";
      echo "<meta http equiv='refresh' content='0; url=./daftar-pasien.php'>";
      header("Location: ./daftar-pasien.php");
      die();
    }
    $_SESSION['sign_up'] = true;
    $_SESSION['id'] = $row['id'];
    $_SESSION['username'] = $nama;
    $_SESSION['no_rm'] = $row['no_rm'];

    echo "<meta http equiv='refresh' content='0; url=./dashboard.php'>";
    header("Location: ./dashboard.php");
    die();
  }

  // Nomor Rekam Medis
  $queryGetRm = "SELECT MAX(SUBSTRING(no_rm, 8)) as last_queue_number FROM pasien";
  $resultRm = mysqli_query($mysqli, $queryGetRm);

  if (!$resultRm) {
    die('Query Gagal: ' . mysqli_error($mysqli));
  }

  // Ambil nomor antrian terakhir
  $rowRm = mysqli_fetch_assoc($resultRm);
  $lastQueueNumber = $rowRm['last_queue_number'];

  $lastQueueNumber = $lastQueueNumber ? $lastQueueNumber : 0;

  // Get Tahun
  $tahun_bulan = date("Ym");

  // Membuat No Antrian Baru
  $newQueueNumber = $lastQueueNumber + 1;

  // Menyusun Nomor Rekam Medis
  $no_rm = $tahun_bulan . "-" . str_pad($newQueueNumber, 3, '0', STR_PAD_LEFT);

  $query = "INSERT INTO pasien (nama, alamat, no_ktp , no_hp, no_rm) VALUES ('$nama', '$alamat', '$no_ktp', '$no_hp', '$no_rm')";

  // Eksekusi Query
  if (mysqli_query($mysqli, $query)) {
    $_SESSION['signup'] = true;
    $_SESSION['id'] = mysqli_insert_id($mysqli);
    $_SESSION['username'] = $nama;
    $_SESSION['no_rm'] = $no_rm;

    // Redirect ke dashboard
    echo "<meta http equiv='refresh' content='0; url=./dashboard.php'>";
    header("Location: ./dashboard.php");
    die();
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Poliklinik BK</title>
  <!--==================== UNICONS ====================-->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
  <!--==================== SWIPER CSS ====================-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11.0.5/swiper-bundle.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!--==================== CSS ====================-->
  <link rel="stylesheet" href="../../config/style.css" />
</head>

<body>
  <header class="header" id="header">
    <nav class="nav container">
      <a href="#" class="nav_logo">Poliklinik</a>

      <!-- <div class="nav_menu" id="nav-menu">
        <ul class="nav_list grid">
          <li class="nav_item">
            <a href="#about" class="nav_link"> <i class="uil uil-user nav_icon"></i> Home </a>
          </li>
          <li class="nav_item">
            <a href="#projects" class="nav_link"> <i class="uil uil-server-network nav_icon"></i> Projects </a>
          </li>
          <li class="nav_item">
            <a href="#messages" class="nav_link"> <i class="uil uil-message nav_icon"></i> Contact Me </a>
          </li>
        </ul>
        <i class="uil uil-times nav_close" id="nav-close"></i>
      </div> -->

    </nav>
  </header>

  <main class="main">
    <!--==================== PROJECT IN MIND ====================-->

    <section class="project section">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-10 mx-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title mt-2 mb-2">Pendaftaran Pasien</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post">
                <div class="card-body">
                  <div class="form-group mt-2 mb-2">
                    <label for="exampleInputEmail1">Nama Lengkap</label>
                    <input type="name" class="form-control mt-2" id="nama_lengkap" name="nama_lengkap" placeholder="Full Name">
                  </div>
                  <div class="form-group mt-2 mb-2">
                    <label for="exampleInputPassword1">Alamat</label>
                    <input type="address" class="form-control mt-2" id="alamat" name="alamat" placeholder="Alamat">
                  </div>
                  <div class="form-group mt-2 mb-2">
                    <label for="exampleInputEmail1">Nomor KTP</label>
                    <input type="ktp" class="form-control mt-2" id="no_ktp" name="no_ktp" placeholder="Nomor KTP [NIK]">
                  </div>
                  <div class="form-group mt-2 mb-2">
                    <label for="exampleInputPassword1">Nomor HP</label>
                    <input type="hp" class="form-control mt-2" id="no_hp" name="no_hp" placeholder="Nomor HP">
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" id="sign_up" name="sign_up" class="btn btn-primary">Login</button>
                  <a href="./index.php" class="btn btn-danger mx-2">Kembali</a>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>

  </main>

  <!--==================== FOOTER ====================-->
  <footer class="bg-body-tertiary text-center text-lg-start fixed-bottom">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2023 Copyright:
      <a class="text-body" href="">Polinklinik BK | Timotius Winsen Bastian</a>
    </div>
    <!-- Copyright -->
  </footer>

  <!--==================== SCROLL TOP ====================-->
  <a href="#" class="scrollup" id="scroll-up">
    <i class="uil uil-arrow-up scroll-up-icon"></i>
  </a>

  <!--==================== SWIPER JS ====================-->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11.0.5/swiper-bundle.min.js"></script>

  <!--==================== MAIN JS ====================-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>