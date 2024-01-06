<?php
include '../../koneksi.php'; //menghubungkan ke file koneksi untuk ke database
$id = $_GET['id']; //menampung id

//query hapus
$datas = mysqli_query($mysqli, "delete from dokter where id ='$id'") or die(mysqli_error($mysqli));

//alert dan redirect ke obat.php
echo "<script>alert('data berhasil dihapus.');window.location='../../views/admin/home_dokter.php';</script>";
