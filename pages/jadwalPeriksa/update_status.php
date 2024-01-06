<?php
include '../../koneksi.php';

// Tangkap data dari permintaan Ajax
$id = $_POST['id'];

// Ambil nilai aktif saat ini dari database
$result = $mysqli->query("SELECT aktif FROM jadwal_periksa WHERE id = $id");

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $currentStatus = $row['aktif'];

  // Lakukan pembaruan status
  $newStatus = ($currentStatus === 'Y') ? 'N' : 'Y';
  $query = "UPDATE jadwal_periksa SET aktif = '$newStatus' WHERE id = $id";

  if ($mysqli->query($query) === TRUE) {
    echo 'success';
  } else {
    echo 'error';
  }
} else {
  echo 'error';
}

// Tutup koneksi
$mysqli->close();
