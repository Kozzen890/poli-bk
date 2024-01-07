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
  <link rel="stylesheet" href="./config/style.css" />
</head>

<body>
  <header class="header" id="header">
    <!-- Image and text -->
    <nav class="navbar navbar-dark bg-body-secondary bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <!-- <img src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp" class="me-2" height="20" alt="MDB Logo" loading="lazy" /> -->
          <small>Poliklinik BK</small>
        </a>
      </div>
    </nav>
  </header>

  <main class="main">
    <!--==================== PROJECT IN MIND ====================-->

    <section class="project section">
      <div class="row mt-2">
        <h2 class="font-weight-bold text-center mb-4">Selamat Datang di Poliklinik</h2>
        <div class="col-sm-5 mx-auto">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Login Sebagai Dokter</h5>
              <p class="card-text">Melakukan Pemeriksaan</p>
              <a href="controllers/controller.php" class="btn btn-primary">Login Dokter</a>
            </div>
          </div>
        </div>
        <div class="col-sm-5 mx-auto">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Login Sebagai Pasien</h5>
              <p class="card-text">Pasien Poliklinik</p>
              <a href="controllers/controller.php" class="btn btn-primary">Login Pasien</a>
            </div>
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
  <script src="./assets/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>