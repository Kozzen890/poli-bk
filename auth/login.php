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
  <link rel="stylesheet" href="../config/net.css" />
</head>

<body>
  <header class="header" id="header">
    <!-- Image and text -->
    <nav class="navbar navbar-dark bg-body-secondary bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <small>Poliklinik BK</small>
        </a>
      </div>
    </nav>
  </header>

  <main class="main">
    <!--==================== PROJECT IN MIND ====================-->

    <section class="project section mt-5">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-10 mx-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title mt-2 mb-2">Login</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="loginForm">
                <div class="card-body">
                  <div class="form-group mt-2 mb-2">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" class="form-control mt-2" id="nama" name="nama" placeholder="Full Name" required>
                  </div>

                  <div class="form-group mt-2 mb-2">
                    <label for="no_hp">Nomor HP</label>
                    <input type="password" class="form-control mt-2" id="no_hp" name="no_hp" placeholder="Nomor HP" required>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" class="btn btn-primary btn-block" onclick="loginUser()">Login</button>
                  <a href="./register.php" class="btn btn-warning mx-2">Register</a>
                </div>
                <div class="card-footer">
                  <a href="../index.php" class="btn btn-danger ">Kembali ke Home</a>
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

  <script>
    function loginUser() {
      var nama = document.getElementById('nama').value;
      var no_hp = document.getElementById('no_hp').value;

      // Kirim data ke PHP untuk proses login
      var xhr = new XMLHttpRequest();
      xhr.open('POST', './loginValidaton.php');
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if (response.status === 'success') {
            // Handle login berhasil
            Swal.fire({
              icon: 'success',
              title: 'Login Berhasil!',
              text: response.welcome_message,
              timer: 3000,
              showConfirmButton: false
            }).then(function() {
              window.location.href = response.redirect_url;
            });
          } else {
            // Handle login gagal
            Swal.fire({
              icon: 'error',
              title: 'Login Gagal',
              text: response.message
            });
          }
        }
      };
      var params = 'nama=' + nama + '&no_hp=' + no_hp;
      xhr.send(params);
    }
  </script>

  <!--==================== SWIPER JS ====================-->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11.0.5/swiper-bundle.min.js"></script>

  <!--==================== MAIN JS ====================-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>