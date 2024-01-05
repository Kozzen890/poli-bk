<?php
include '../koneksi.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $user_id = $_POST["id_pasien"];
    $id_jadwal = $_POST["id_jadwal"];
    $keluhan = $_POST["keluhan"];
    $no_antrian = getQueueNumbers($id_jadwal) + 1;



    // Query untuk menambahkan data ke dalam tabel
    $query = "INSERT INTO daftar_poli (id_pasien, id_jadwal, keluhan, no_antrian) VALUES ('$user_id', '$id_jadwal', '$keluhan', '$no_antrian')";

    // Eksekusi query
    if (mysqli_query($mysqli, $query)) {
        echo '<script>';
        echo 'alert("Data Daftar Poliklinik berhasil ditambahkan!");';
        echo 'window.location.href = "../home_poli_pasien.php";';
        echo '</script>';
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
}

function getQueueNumbers($id_jadwal)
{
    include '../koneksi.php';
    $id_jadwal_sanitized = mysqli_real_escape_string($mysqli, $id_jadwal);
    $queryQueue = "SELECT MAX(no_antrian) as max_no_antrian FROM daftar_poli WHERE id_jadwal = '$id_jadwal_sanitized'";
    $resultQueue = mysqli_query($mysqli, $queryQueue);

    if ($resultQueue) {
        // Fetch the result row
        $rowQueue = mysqli_fetch_assoc($resultQueue);

        // Use the result
        $latest_no_antrian = $rowQueue['max_no_antrian'] ? $rowQueue['max_no_antrian'] : 0;

        // Free the result set
        mysqli_free_result($resultQueue);

        return $latest_no_antrian;
    } else {
        // Handle the error if the query fails
        echo "Error: " . mysqli_error($mysqli);
        return 0;
    }
}

// Tutup koneksi
mysqli_close($mysqli);
