<?php
include '../../koneksi.php';

if (isset($_POST['submit'])) {
  $id_daftar_poli = $_POST['id'];
  $tgl_periksa = $_POST['tgl_periksa'];
  $catatan = $_POST['catatan'];
  $obat = $_POST['obat'];

  $total_harga_obat = 0;
  $total_jasa = 150000;
  if (!empty($obat)) {
    foreach ($obat as $id_obat) {
      // Pastikan untuk membersihkan data input sebelum menggunakannya pada query
      $id_obat = mysqli_real_escape_string($mysqli, $id_obat);

      // Eksekusi query langsung tanpa prepared statement
      $query_obat_harga = "SELECT harga FROM obat WHERE id = '$id_obat'";
      $result_obat_harga = mysqli_query($mysqli, $query_obat_harga);

      if ($result_obat_harga) {
        $harga_obat = mysqli_fetch_assoc($result_obat_harga)['harga'];
        $total_harga_obat += $harga_obat;
      } else {
        // Handle error jika query tidak berhasil
        echo "Error: " . mysqli_error($mysqli);
      }
    }
  }

  // Query Data Periksa
  $total_harga = $total_harga_obat + $total_jasa;
  $query_periksa = "UPDATE periksa SET id_daftar_poli = '$id_daftar_poli', tgl_periksa = '$tgl_periksa', catatan = '$catatan', biaya_periksa = '$total_harga' WHERE id = $id_periksa";
  $result_periksa = mysqli_query($mysqli, $query_periksa);

  // Hapus semua obat terkait dengan id_periksa
  $query_delete_obat = "DELETE FROM detail_periksa WHERE id_periksa = $id_periksa";
  mysqli_query($mysqli, $query_delete_obat);

  // Tambahkan obat-obat yang baru dipilih
  if (!empty($obat)) {
    foreach ($obat as $id_obat) {
      $query_insert_obat = "INSERT INTO detail_periksa (id_periksa, id_obat) VALUES ($id_periksa, $id_obat)";
      mysqli_query($mysqli, $query_insert_obat);
    }
  }
  header('LOCATION : ../../views/dokter/home_periksa.php');
  exit();
}
