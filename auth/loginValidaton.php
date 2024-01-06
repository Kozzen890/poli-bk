<?php
session_start();

// Sambungkan ke database
$conn = mysqli_connect('localhost', 'root', 'root', 'poliklinik_bk');

// Ambil data dari form login
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);

// Query menggunakan prepared statement
$query = "SELECT ur.*, d.id AS id_dokter, d.alamat AS alamat_dokter, d.no_hp AS no_hp_dokter,
                 p.id AS id_pasien, p.no_rm
          FROM user_roles ur
          LEFT JOIN dokter d ON ur.nama = d.nama
          LEFT JOIN pasien p ON ur.nama = p.nama
          WHERE ur.nama=? AND ur.no_hp=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ss", $nama, $no_hp);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 1) {
  $row = mysqli_fetch_assoc($result);
  $_SESSION['user_id'] = $row['id'];
  $_SESSION['role_id'] = $row['role_id'];
  $_SESSION['nama'] = $row['nama'];

  // Jika user adalah dokter, simpan informasi dokter dalam session
  if ($row['role_id'] == 2) {
    $_SESSION['id_dokter'] = $row['id_dokter'];
    $_SESSION['alamat_dokter'] = $row['alamat_dokter'];
    $_SESSION['no_hp_dokter'] = $row['no_hp_dokter'];
  }

  // Jika user adalah pasien, simpan informasi pasien dalam session
  if ($row['role_id'] == 3) {
    $_SESSION['id_pasien'] = $row['id_pasien'];
    $_SESSION['no_rm'] = $row['no_rm'];
  }

  $role = $row['role_id'];
  $redirect_url = '';
  $welcomeMessage = '';

  switch ($role) {
    case '1':
      $redirect_url = '../views/home/dashboard.php';
      $welcomeMessage = 'Selamat datang, Admin ' . ucfirst($row['nama']) . '!';
      break;
    case '2':
      $redirect_url = '../views/home/dashboard.php';
      $welcomeMessage = 'Selamat datang, Dokter ' . ucfirst($row['nama']) . '!';
      break;
    case '3':
      $redirect_url = '../views/home/dashboard.php';
      $welcomeMessage = 'Selamat datang, Pasien ' . ucfirst($row['nama']) . '!';
      break;
    default:
      $redirect_url = 'default.php'; // URL default jika role tidak ditemukan
      break;
  }

  echo json_encode(['status' => 'success', 'redirect_url' => $redirect_url, 'welcome_message' => $welcomeMessage]);
} else {
  echo json_encode(['status' => 'error', 'message' => 'Username atau nomor handphone salah. Silakan coba lagi.']);
}
