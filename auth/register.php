<?php
include '../koneksi.php';

$tahun_bulan = date('Ym');

$query_no_rm = "SELECT MAX(SUBSTRING_INDEX(no_rm, '-', -1)) as max_no_rm FROM pasien WHERE SUBSTRING_INDEX(no_rm, '-', 1) = '$tahun_bulan'";
$result_no_rm = mysqli_query($mysqli, $query_no_rm);
$row_no_rm = mysqli_fetch_assoc($result_no_rm);
$max_no_rm = $row_no_rm['max_no_rm'];

if ($max_no_rm === null) {
  $nomor_rm = 1;
} else {
  // Jika sudah ada antrian, tambahkan 1
  $nomor_rm = $max_no_rm + 1;
}

// Format antrian sesuai kebutuhan
$no_rm = sprintf("%s-%03d", $tahun_bulan, $nomor_rm);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Poliklinik BK | Pendaftaran dan Login Pasien</title>
  <!--==================== UNICONS ====================-->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
  <!--==================== SWIPER CSS ====================-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11.0.5/swiper-bundle.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!--==================== CSS ====================-->
  <link rel="stylesheet" href="../config/style.css" />
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
              <form id="registerForm">
                <div class="card-body">
                  <div class="form-group mt-2 mb-2">
                    <label for="exampleInputEmail1">Nama Lengkap</label>
                    <input type="nama" class="form-control mt-2" id="nama" name="nama" placeholder="Full Name">
                  </div>
                  <div class="form-group mt-2 mb-2">
                    <label for="exampleInputPassword1">Alamat</label>
                    <input type="alamat" class="form-control mt-2" id="alamat" name="alamat" placeholder="Alamat">
                  </div>
                  <div class="form-group mt-2 mb-2">
                    <label for="exampleInputEmail1">Nomor KTP</label>
                    <input type="no_ktp" class="form-control mt-2" id="no_ktp" name="no_ktp" placeholder="Nomor KTP [NIK]">
                  </div>
                  <div class="form-group mt-2 mb-2">
                    <label for="exampleInputPassword1">Nomor HP</label>
                    <input type="no_hp" class="form-control mt-2" id="no_hp" name="no_hp" placeholder="Nomor HP">
                  </div>
                  <div class="form-group mt-2 mb-2">
                    <input type="hidden" id="no_rm" name="no_rm" value="<?= $no_rm ?>" required>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" class="btn btn-primary btn-block" onclick="registerUser()">Register</button>
                  <a href="../index.php" class="btn btn-danger mx-2">Kembali</a>
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

  <script>
    function registerUser() {
      var nama = document.getElementById('nama').value;
      var alamat = document.getElementById('alamat').value;
      var no_ktp = document.getElementById('no_ktp').value;
      var no_hp = document.getElementById('no_hp').value;
      var no_rm = document.getElementById('no_rm').value;

      // Kirim data ke PHP untuk proses registrasi
      var xhr = new XMLHttpRequest();
      xhr.open('POST', './registerValidation.php');
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if (response.success) {
            // Handle registrasi berhasil
            Swal.fire({
              icon: 'success',
              title: 'Registrasi Berhasil!',
              text: response.message,
              timer: 3000,
              showConfirmButton: false
            }).then(function() {
              window.location.href = './login.php';
            });
          } else {
            // Handle registrasi gagal
            Swal.fire({
              icon: 'error',
              title: 'Registrasi Gagal',
              text: response.message
            });
          }
        }
      };
      var params = 'nama=' + nama + '&alamat=' + alamat + '&no_ktp=' + no_ktp + '&no_hp=' + no_hp + '&no_rm=' + no_rm;
      xhr.send(params);
    }
  </script>
</body>

</html>