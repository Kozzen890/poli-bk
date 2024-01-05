<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_poli = mysqli_real_escape_string($mysqli, $_POST['id_poli']);

    // Query untuk mengambil data jadwal_periksa berdasarkan id_poli
    $queryJadwal = "SELECT a.nama as nama_dokter,
                                    b.hari as hari,
                                    b.id as id_jp,
                                    b.jam_mulai as jam_mulai,
                                    b.jam_selesai as jam_selesai
                            FROM dokter as a 
                            INNER JOIN jadwal_periksa as b ON a.id = b.id_dokter
                            WHERE a.id_poli = $id_poli";

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
