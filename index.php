<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Personal Website</title>
  <!--==================== UNICONS ====================-->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
  <!--==================== SWIPER CSS ====================-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11.0.5/swiper-bundle.min.css">

  <!--==================== CSS ====================-->
  <link rel="stylesheet" href="./config/style.css" />
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
      <div class="project_bg">
        <div class="project_container container grid">
          <div class="project_data">
            <h2 class="project_title">Admin</h2>
            <p class="project_desc">Melakukan Management pada sistem Poliklinik</p>
          </div>

          <a href="./login-admin.php" class="button button-flex button-white project_img"> Login Admin
            <i class="uil uil-chat project_icon button_icon"></i>
          </a>
        </div>
      </div>

      <div class="project_bg">
        <div class="project_container container grid">
          <div class="project_data">
            <h2 class="project_title">Dokter</h2>
            <p class="project_desc">Memeriksa Pasien</p>
          </div>

          <a href="./logout-dokter.php" class="button button-flex button-white project_img"> Login Dokter
            <i class="uil uil-chat project_icon button_icon"></i>
          </a>
        </div>
      </div>
    </section>

  </main>

  <!--==================== FOOTER ====================-->
  <footer class="footer">
    <div class="footer_bg">
      <p class="footer_copy">&#169; 2023 Poliklinik BK, all rights reserved</p>
    </div>
  </footer>

  <!--==================== SCROLL TOP ====================-->
  <a href="#" class="scrollup" id="scroll-up">
    <i class="uil uil-arrow-up scroll-up-icon"></i>
  </a>

  <!--==================== SWIPER JS ====================-->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11.0.5/swiper-bundle.min.js"></script>

  <!--==================== MAIN JS ====================-->
  <script src="./assets/js/main.js"></script>
</body>

</html>