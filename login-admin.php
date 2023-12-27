<?php
include 'koneksi.php';
session_start();

if (isset($_SESSION['login'])) {
  header("Location: menu/admin/");
  exit();
}

if (isset($_POST['login'])) {
  $username = mysqli_real_escape_string($mysqli, $_POST['username']);
  $password = $_POST['password'];

  $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
  $result = mysqli_query($mysqli, $query);

  if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['login'] = $row['username'];
    header("Location: menu/admin/");
    exit();
  } else {
    echo "<script>alert('Username atau password Anda salah. Silakan coba lagi!')</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="helper/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="helper/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="helper/AdminLTE/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page ">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Poliklinik</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Login Admin</p>

        <?php
        $errors = array(); // Menambahkan inisialisasi variabel $errors
        if (count($errors) > 0) {
          foreach ($errors as $showerror) {
        ?>
            <div class="alert alert-danger text-center" style="font-weight: 600;">
              <?php
              echo $showerror;
              ?>
            </div>
        <?php
          }
        }
        ?>

        <form action="#" method="post">
          <div class="input-group mb-3">
            <input type="username" name="username" id="username" class="form-control" placeholder="Username | Case Sensitive">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password | Case Sensitive">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="helper/AdminLTE/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="helper/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="helper/AdminLTE/dist/js/adminlte.min.js"></script>
</body>

</html>