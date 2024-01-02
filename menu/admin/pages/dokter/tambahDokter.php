<?php
include '../../../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Ambil nilai dari form
  $nama_dokter = $_POST["nama_dokter"];
  $alamat = $_POST["alamat"];
  $no_hp = $_POST["no_hp"];
  $id_poli = $_POST["id_poli"];

  // Query untuk menambahkan data obat ke dalam tabel
  $query = "INSERT INTO dokter (nama, alamat, no_hp, id_poli) VALUES ('$nama_dokter', '$alamat', '$no_hp', '$id_poli')";

  // if ($koneksi->query($query) === TRUE) {
  // Eksekusi query
  if (mysqli_query($mysqli, $query)) {
    // Jika berhasil, redirect kembali ke halaman utama atau sesuaikan dengan kebutuhan Anda
    // header("Location: ../../index.php");
    // exit();
    echo '<script>';
    echo 'alert("Data obat berhasil ditambahkan!");';
    echo 'window.location.href = "../../menu_dokter.php";';
    echo '</script>';
    exit();
  } else {
    // Jika terjadi kesalahan, tampilkan pesan error
    echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
  }
}

// Tutup koneksi
mysqli_close($mysqli);
