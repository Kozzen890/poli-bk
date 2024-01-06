<?php
include './koneksi.php';

$query = "SELECT * FROM dokter";
$result = mysqli_query($mysqli, $query);

$dokters = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Manajemen Dokter</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="dashboard.php?page=home">Home</a></li>
          <li class="breadcrumb-item active">Dokter</li>
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
            <h3 class="card-title">Data Dokter</h3>

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
                  <th>Nomor</th>
                  <th>Nama Dokter</th>
                  <th>Alamat</th>
                  <th>No_hp</th>
                  <th>Poli</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <?php $nomor = 1; ?>
              <?php foreach ($dokters as $dokter) : ?>
                <tbody>
                  <td><?= $nomor; ?></td>
                  <td><?= $dokter["nama"];  ?></td>
                  <td><?= $dokter["alamat"];  ?></td>
                  <td><?= $dokter["no_hp"];  ?></td>
                  <td>
                    <?php
                    // Lakukan query untuk mendapatkan nama poli berdasarkan id_poli
                    $id_poli = $dokter["id_poli"];
                    $query = "SELECT nama_poli FROM poli WHERE id = $id_poli";
                    // Eksekusi query dan ambil hasilnya
                    $result = mysqli_query($mysqli, $query);
                    $row = mysqli_fetch_assoc($result);
                    $nama_poli = $row['nama_poli'];
                    echo $nama_poli;
                    ?>
                  </td>
                  <td>
                    <button type='button' class='btn btn-sm btn-warning edit-btn' data-obatid='<?= $dokter['id']; ?>'>Edit</button>
                    <a href='pages/dokter/hapusDokter.php?id=<?= $dokter['id']; ?>' class='btn btn-sm btn-danger' onclick='return confirm("Anda yakin ingin hapus?");'>Hapus</a>
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
          <h5 class="modal-title" id="addModalLabel">Tambah Data Dokter</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Form tambah data obat disini -->
          <form action="pages/dokter/tambahDokter.php" method="post">
            <div class="form-group">
              <label for="nama">Nama Dokter</label>
              <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>
            <div class="form-group">
              <label for="no_hp">Nomor Hp</label>
              <input type="text" class="form-control" id="no_hp" name="no_hp" required>
            </div>
            <div class="form-group">
              <label for="id_poli">Poli</label>
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
        $('#seg-modal').load('pages/dokter/editDokter.php?id=' + dataId, function() {
          $('#editModal').modal('show');
        });
      });
    });
  </script>

</div>