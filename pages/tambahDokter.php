<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $no_hp = $_POST["no_hp"];
    $id_poli = $_POST["id_poli"];

    // Query untuk menambahkan data obat ke dalam tabel
    $query = "INSERT INTO dokter (nama, alamat, no_hp, id_poli) VALUES ('$nama', '$alamat', '$no_hp', '$id_poli')";


    // if ($koneksi->query($query) === TRUE) {
    // Eksekusi query
    try {
        // Eksekusi query
        if (mysqli_query($mysqli, $query)) {
            // Jika berhasil, redirect kembali ke halaman utama atau sesuaikan dengan kebutuhan Anda
            echo '<script>';
            echo 'alert("Data dokter berhasil ditambahkan!");';
            echo 'window.location.href = "../home_dokter.php";';
            echo '</script>';
            exit();
        } else {
            // Jika terjadi kesalahan, tampilkan pesan error SQL
            throw new Exception(mysqli_error($mysqli));
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Tutup koneksi
mysqli_close($mysqli);
