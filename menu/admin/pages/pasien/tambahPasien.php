<?php
include '../../../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Ambil nilai dari form
  $nama = $_POST["nama_pasien"];
  $alamat = $_POST["alamat"];
  $no_ktp = $_POST["no_ktp"];
  $no_hp = $_POST["no_hp"];

  // Query untuk menambahkan data obat ke dalam tabel
  $query = "INSERT INTO pasien (nama, alamat, no_ktp, no_hp) VALUES ('$nama', '$alamat', '$no_ktp', '$no_hp')";


  // if ($koneksi->query($query) === TRUE) {
  // Eksekusi query
  if (mysqli_query($mysqli, $query)) {
    // Jika berhasil, redirect kembali ke halaman utama atau sesuaikan dengan kebutuhan Anda
    // header("Location: ../../index.php");
    // exit();
    echo '<script>';
    echo 'alert("Data Pasien berhasil ditambahkan!");';
    echo 'window.location.href = "../../menu_pasien.php";';
    echo '</script>';
    exit();
  } else {
    // Jika terjadi kesalahan, tampilkan pesan error
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
  }
}

// Tutup koneksi
mysqli_close($mysqli);
