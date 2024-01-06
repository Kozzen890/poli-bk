<?php
include '../../koneksi.php';
$user_id = $_SESSION['user_id'];
$role_id = $_SESSION['role_id'];
$nama = $_SESSION['nama']; // Ambil nama dari session

$query = "SELECT jadwal_periksa.*, dokter.nama as nama_dokter
    FROM jadwal_periksa
    INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id
    INNER JOIN user_roles ON dokter.nama = user_roles.nama
    WHERE user_roles.nama = '$nama'";
$result = mysqli_query($mysqli, $query);

$id_dokter = isset($_SESSION['id_dokter']) ? $_SESSION['id_dokter'] : '';

$jadwals = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Jadwal Periksa Dokter <?php echo $nama ?></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="dashboard.php?page=home">Home</a></li>
          <li class="breadcrumb-item active">Jadwal Periksa</li>
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
          <div class="card-header">
            <h3 class="card-title">Data Jadwal Periksa</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#addModal">
                Tambah
              </button>
            </div>
          </div>
          <!-- /.card-header -->


          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Hari</th>
                  <th>Jam Mulai</th>
                  <th>Jam Selesai</th>
                  <th>Status</th>
                </tr>
              </thead>
              <?php $nomor = 1; ?>
              <?php foreach ($jadwals as $jadwal) : ?>
                <tbody>
                  <td><?= $nomor; ?></td>
                  <td><?= $jadwal["hari"];  ?></td>
                  <td><?= $jadwal["jam_mulai"];  ?></td>
                  <td><?= $jadwal["jam_selesai"];  ?></td>
                  <td>
                    <?php
                    if ($jadwal["aktif"] == 'Y') {
                      echo "<button class='btn btn-sm btn-primary' onclick='toggleStatus(" . $jadwal['id'] . ")'>Aktif</button>";
                    } else {
                      echo "<button class='btn btn-sm btn-danger' onclick='toggleStatus(" . $jadwal['id'] . ")'>Tidak Aktif</button>";
                    };
                    ?>
                    <!-- <button type='button' class='btn btn-sm btn-warning edit-btn' data-obatid='<?= $jadwal['id']; ?>'>Edit</button>
                    <a href='pages/hapusJadwal.php?id=<?= $jadwal['id']; ?>' class='btn btn-sm btn-danger' onclick='return confirm("Anda yakin ingin hapus?");'>Hapus</a> -->
                  </td>
                </tbody>
                <?php $nomor++; ?>
              <?php endforeach; ?>
            </table>
          </div>
          <!-- /.card-body -->
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
          <h5 class="modal-title" id="addModalLabel">Tambah Data Jadwal Periksa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Form tambah data obat disini -->
          <form action="../../pages/jadwalPeriksa/tambahJadwal.php" method="post">
            <div class="form-group">
              <input type="hidden" class="form-control" id="id_dokter" name="id_dokter" value="<?= $id_dokter ?>" required>
            </div>
            <div class="form-group">
              <label for="hari">Hari</label>
              <select class="form-control" id="hari" name="hari" required>
                <option value="" disabled selected>Pilih Hari</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
              </select>
            </div>

            <div class="form-group">
              <label for="jam_mulai">Jam Mulai</label>
              <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
            </div>
            <div class=" form-group">
              <label for="jam_selesai">Jam Selesai</label>
              <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
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
        $('#seg-modal').load('pages/editJadwal.php?id=' + dataId, function() {
          $('#editModal').modal('show');
        });
      });
    });
  </script>

  <script>
    function toggleStatus(id) {
      var confirmation = confirm("Apakah Anda yakin ingin mengubah status?");

      if (confirmation) {

        // Kirim permintaan Ajax ke server
        $.ajax({
          url: '../../pages/jadwalPeriksa/update_status.php', // Ganti dengan nama skrip PHP yang menangani pembaruan status
          method: 'POST',
          data: {
            id: id
          },
          success: function(response) {
            // Pembaruan status di halaman tanpa me-refresh
            if (response === 'success') {
              // Perbarui tombol secara langsung
              var button = $('[onclick="toggleStatus(' + id + ')"]');
              var newStatus = (button.text() === 'Aktif') ? 'Tidak Aktif' : 'Aktif';

              if (newStatus === 'Aktif') {
                button.removeClass('btn-danger').addClass('btn-primary');
              } else {
                button.removeClass('btn-primary').addClass('btn-danger');
              }
              button.html(newStatus);

              alert('Status berhasil diperbarui: ' + newStatus);
            } else {
              alert('Gagal memperbarui status');
            }
          },
          error: function() {
            alert('Terjadi kesalahan');
          }
        });
      } else {
        alert('Perubahan status dibatalkan');
      }
    }
  </script>

</div>