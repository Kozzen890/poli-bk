<?php
$databaseHost = 'localhost';
$databaseName = 'poliklinik_bk';
$databaseUsername = 'root';
$databasePassword = 'root';

$mysqli = mysqli_connect(
  $databaseHost,
  $databaseUsername,
  $databasePassword,
  $databaseName
);

// Periksa koneksi
if (!$mysqli) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
