<?php
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Ambil nilai dari form
  $id_dokter = $_POST["id_dokter"];
  $hari = $_POST["hari"];
  $jam_mulai = $_POST["jam_mulai"];
  $jam_selesai = $_POST["jam_selesai"];



  // Query untuk menambahkan data ke dalam tabel
  $query = "INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai) VALUES ('$id_dokter', '$hari', '$jam_mulai', '$jam_selesai')";

  // Eksekusi query
  if (mysqli_query($mysqli, $query)) {
    echo '<script>';
    echo 'alert("Data Jadwal Periksa berhasil ditambahkan!");';
    echo 'window.location.href = "../../views/dokter/home_jadwal_periksa.php";';
    echo '</script>';
    exit();
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
  }
}

// Tutup koneksi
mysqli_close($mysqli);
