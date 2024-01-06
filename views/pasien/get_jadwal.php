<?php
include '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_poli = mysqli_real_escape_string($mysqli, $_POST['id_poli']);

    // Query untuk mengambil data jadwal_periksa berdasarkan id_poli
    $queryJadwal = "SELECT jp.id, jp.hari, ' ', jp.jam_mulai, jp.jam_selesai, d.nama FROM jadwal_periksa jp
                    INNER JOIN dokter d ON jp.id_dokter = d.id
                    WHERE d.id_poli = $id_poli AND jp.aktif = 'Y'";

    $resultJadwal = mysqli_query($mysqli, $queryJadwal);

    // Format hasil query menjadi array yang dapat diolah oleh JavaScript
    $dataJadwal = [];
    while ($jadwal = mysqli_fetch_assoc($resultJadwal)) {
        $dataJadwal[] = $jadwal;
    }

    // Kembalikan data dalam format JSON
    echo json_encode($dataJadwal);
} else {
    // Jika bukan permintaan POST, kembalikan response kosong atau sesuai kebutuhan
    echo json_encode([]);
}
