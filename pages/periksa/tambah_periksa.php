<?php
include '../../koneksi.php';

if (isset($_POST['submit'])) {
  $id_daftar_poli = $_POST['id'];
  $tgl_periksa = $_POST['tanggal_periksa'];
  $catatan = $_POST['catatan'];
  $obat = $_POST['obat'];


  // Hitung Total Harga Obat
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
  $query_periksa = "INSERT INTO periksa (id_daftar_poli, tgl_periksa, catatan, biaya_periksa) VALUES ('$id_daftar_poli', '$tgl_periksa', '$catatan', '$total_harga')";
  $result_periksa = mysqli_query($mysqli, $query_periksa);

  if ($result_periksa) {
    $id_periksa = mysqli_insert_id($mysqli);

    // Query Data Obat
    if (!empty($obat)) {
      foreach ($obat as $id_obat) {
        // Pastikan membersihkan data input
        $id_obat = mysqli_real_escape_string($mysqli, $id_obat);

        $query_obat = "INSERT INTO detail_periksa (id_periksa, id_obat) VALUES ('$id_periksa', '$id_obat')";
        $result_obat = mysqli_query($mysqli, $query_obat);

        if (!$result_obat) {
          // Handle error jika query tidak berhasil
          echo "Error: " . mysqli_error($mysqli);
        }
      }
    }
  } else {
    // Handle error jika query tidak berhasil
    echo "Error: " . mysqli_error($mysqli);
  }

  // Query Data Daftar Poli
  $query_daftar_poli = "UPDATE daftar_poli SET status_periksa = 1 WHERE id = '$id_daftar_poli'";
  $result_daftar_poli = mysqli_query($mysqli, $query_daftar_poli);

  if ($result_daftar_poli) {
    header('Location: ../../views/dokter/home_periksa.php');
    exit();
  } else {
    // Handle error jika query tidak berhasil
    echo "Error: " . mysqli_error($mysqli);
  }
}
