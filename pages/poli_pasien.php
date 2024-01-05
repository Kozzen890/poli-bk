<?php
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$tahun_bulan = date('Ym');

$user_id = $_SESSION['user_id'];
$role_id = $_SESSION['role_id'];
$nama = $_SESSION['nama']; // Ambil nama dari session
$no_rm = $_SESSION['no_rm'];

$query_antrian = "SELECT MAX(SUBSTRING_INDEX(no_antrian, '-', -1)) as max_antrian FROM daftar_poli WHERE SUBSTRING_INDEX(no_antrian, '-', 1) = '$tahun_bulan'";
$result_antrian = mysqli_query($mysqli, $query_antrian);
$row_antrian = mysqli_fetch_assoc($result_antrian);
$max_antrian = $row_antrian['max_antrian'];

if ($max_antrian === null) {
    $nomor_antrian = 1;
} else {
    // Jika sudah ada antrian, tambahkan 1
    $nomor_antrian = $max_antrian + 1;
}

// Format antrian sesuai kebutuhan
$antrian = sprintf("%s-%03d", $tahun_bulan, $nomor_antrian);

$query = "SELECT * FROM poli";
$result = mysqli_query($mysqli, $query);

$polis = mysqli_fetch_all($result, MYSQLI_ASSOC);

$id_pasien = isset($_SESSION['id_pasien']) ? $_SESSION['id_pasien'] : '';
$no_rm = isset($_SESSION['no_rm']) ? $_SESSION['no_rm'] : '';
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Daftar Poli Klinik</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="dashboard.php?page=home">Home</a></li>
                    <li class="breadcrumb-item active">Poli Klinik</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-5 connectedSortable">
                <!-- Form Daftar Poliklinik-->
                <div class="card">
                    <div class="card-header bg-gradient-primary">
                        <h3 class="card-title">
                            Daftar Poliklinik
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="pages/tambah_daftar_poli.php" method="post">
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="id_pasien" name="id_pasien" value="<?= $id_pasien ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="no_rm">Nomor Rekam Medis</label>
                                <input type="text" class="form-control" id="no_rm" name="no_rm" value="<?= $no_rm ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="id_poli">Pilih Poli</label>
                                <select class="form-control" id="id_poli" name="id_poli" required>
                                    <option value="" disabled selected>Pilih Poli</option>
                                    <?php
                                    // Ambil data poli dari tabel poli
                                    $queryPoli = "SELECT * FROM poli";
                                    $resultPoli = mysqli_query($mysqli, $queryPoli);

                                    // Tampilkan data poli sebagai option dalam dropdown
                                    while ($poli = mysqli_fetch_assoc($resultPoli)) {
                                        echo "<option value='{$poli["id"]}'>{$poli["nama_poli"]}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_jadwal">Pilih Jadwal</label>
                                <select class="form-control" id="id_jadwal" name="id_jadwal" required>
                                    <option value="" disabled selected>Pilih Jadwal</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="keluhan">Keluhan</label>
                                <input type="text" class="form-control" id="keluhan" name="keluhan" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>

            </section>
            <section class="col-lg-7 connectedSortable">

                <!-- Riawayat Daftar Poli -->
                <div class="card ">
                    <div class="card-header border-0 bg-gradient-primary">
                        <h2 class="card-title">
                            Riwayat Daftar Poli
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-hover">
                                <thead class="bg-grey1">
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Poli</th>
                                        <th class="text-center">Tanggal Periksa</th>
                                        <th class="text-center">Catatan Periksa</th>
                                        <th class="text-center">Biaya Periksa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </section>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    <!-- Modal Edit Data Obat -->
    <div id="seg-modal">

    </div>
    <!-- Modal Tambah Data Obat -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Poli</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form tambah data obat disini -->
                    <form action="pages/tambahPoli.php" method="post">
                        <div class="form-group">
                            <label for="nama_poli">Nama Poli</label>
                            <input type="text" class="form-control" id="nama_poli" name="nama_poli" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambahkan tag script untuk jQuery sebelum script Anda -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.edit-btn').on('click', function() {
                var dataId = $(this).data('obatid');
                $('#seg-modal').load('pages/editPoli.php?id=' + dataId, function() {
                    $('#editModal').modal('show');
                });
            });
        });
    </script>
    <!-- script pilih jadwal -->
    <script>
        $(document).ready(function() {
            // Event listener untuk perubahan pada dropdown "Pilih Poli"
            $('#id_poli').on('change', function() {
                var selectedPoli = $(this).val();

                // Kirim permintaan AJAX untuk mengambil data jadwal_periksa berdasarkan poli yang dipilih
                $.ajax({
                    url: 'get_jadwal.php', // Ganti dengan file yang akan menangani permintaan
                    method: 'POST',
                    data: {
                        id_poli: selectedPoli
                    },
                    dataType: 'json',
                    success: function(data) {
                        // Bersihkan dan tambahkan data jadwal_periksa ke dropdown "Pilih Jadwal"
                        $('#id_jadwal').empty();
                        $.each(data, function(key, value) {
                            $('#id_jadwal').append('<option value="' + value.id + '">' + value.hari + ' ' + value.jam_mulai + ' - ' + value.jam_selesai + '</option>');
                        });

                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>


</div>