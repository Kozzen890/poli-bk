<?php
include 'koneksi.php';

// Mengambil nilai id dari parameter URL
$id_periksa = $_GET['id'];

// Query untuk mengambil data dari tabel daftar_poli berdasarkan id
$query = "SELECT daftar_poli.*, pasien.nama AS nama_pasien
    FROM daftar_poli
    INNER JOIN pasien ON daftar_poli.id_pasien = pasien.id
    WHERE daftar_poli.id = $id_periksa";

$result = mysqli_query($mysqli, $query);

// Mengambil hasil query sebagai array asosiatif
$periksas = mysqli_fetch_assoc($result);

// Cek apakah data ditemukan
if (!$periksas) {
  // Handle jika data tidak ditemukan, misalnya redirect atau tampilkan pesan
  echo "Data tidak ditemukan.";
  exit;
}

echo '<pre>';
var_dump($periksas); // atau print_r($polis);
echo '</pre>';
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Periksa Pasien</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="dashboard.php?page=home">Home</a></li>
          <li class="breadcrumb-item active">Periksa Pasien</li>
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
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-gradient-primary">
            <h3 class="card-title">
              Periksa Pasien
            </h3>
          </div>
          <div class="card-body">
            <form action="pages/updateProfile.php" method="post">
              <div class="form-group">
                <input type="text" class="form-control" id="id" name="id" value="<?= $row['id']; ?>" required>
              </div>
              <div class="form-group">
                <label for="nama">Nama Pasien</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $periksas['nama_pasien']; ?>" readonly>
              </div>
              <div class="form-group">
                <label for="alamat">Tanggal Periksa</label>
                <input type="date" class="form-control" id="alamat" name="alamat">
              </div>
              <div class="form-group">
                <label for="no_hp">Catatan</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp">
              </div>
              <div class="form-group">
                <label for="no_hp">Obat</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $row['no_hp']; ?>">
              </div>


              <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>

        <!-- /.card -->
      </div>
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

</div>