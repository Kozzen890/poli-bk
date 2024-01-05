<?php
// Koneksi ke database (Sesuaikan dengan koneksi Anda)
$conn = mysqli_connect('localhost', 'root', 'root', 'poliklinik_bk');

if (!$conn) {
  die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Ambil data dari form registrasi
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_ktp = $_POST['no_ktp'];
$no_hp = $_POST['no_hp'];
$no_rm = $_POST['no_rm'];

// Verifikasi apakah data sudah ada dalam database
$checkQuery = "SELECT * FROM pasien WHERE nama='$nama'";
$checkResult = mysqli_query($conn, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
  // Jika data nama sudah ada, kirim response error
  $response = [
    'success' => false,
    'message' => 'Registrasi Gagal. Nama sudah terdaftar.'
  ];
} else {
  // Jika data nama belum ada, lanjutkan ke pengecekan no_ktp
  $checkQuery = "SELECT * FROM pasien WHERE no_ktp='$no_ktp'";
  $checkResult = mysqli_query($conn, $checkQuery);

  if (mysqli_num_rows($checkResult) > 0) {
    // Jika data no_ktp sudah ada, kirim response error
    $response = [
      'success' => false,
      'message' => 'Registrasi Gagal. Nomor KTP sudah terdaftar.'
    ];
  } else {
    // Jika data no_ktp belum ada, lanjutkan ke pengecekan no_hp
    $checkQuery = "SELECT * FROM pasien WHERE no_hp='$no_hp'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
      // Jika data no_hp sudah ada, kirim response error
      $response = [
        'success' => false,
        'message' => 'Registrasi Gagal. Nomor HP sudah terdaftar.'
      ];
    } else {
      // Jika semua pengecekan berhasil, lakukan operasi INSERT
      $query = "INSERT INTO pasien (nama, alamat, no_ktp, no_hp, no_rm) VALUES ('$nama', '$alamat', '$no_ktp', '$no_hp', '$no_rm')";
      $result = mysqli_query($conn, $query);

      if ($result) {
        // Registrasi sukses
        $response = [
          'success' => true,
          'message' => 'Registrasi Pasien Berhasil! Pasien berhasil terdaftar.'
        ];
      } else {
        // Registrasi gagal
        $response = [
          'success' => false,
          'message' => 'Registrasi Pasien Gagal. Terjadi kesalahan. Silakan coba lagi.'
        ];
      }
    }
  }
}

mysqli_close($conn);

// Mengirim response dalam bentuk JSON
header('Content-Type: application/json');
echo json_encode($response);
