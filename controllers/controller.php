<?php
session_start();

// Memeriksa apakah ada sesi user_id dan role yang tersimpan
if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
  $role = $_SESSION['role'];

  // Redirect ke halaman sesuai dengan peran (role) pengguna
  if ($role === '1') {
    header('Location: ../views/home/dashboard.php');
    exit();
  } elseif ($role === '2') {
    header('Location: ../views/home/dashboard.php');
    exit();
  } elseif ($role === '3') {
    header('Location: ../views/home/dashboard.php');
    exit();
  }
} else {
  // Jika tidak ada sesi, kembalikan ke halaman login atau halaman lain yang sesuai
  header('Location: ../auth/login.php');
  exit();
}
