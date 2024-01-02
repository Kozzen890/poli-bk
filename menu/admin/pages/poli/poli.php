<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Manajemen Poli</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?page=home">Home</a></li>
          <li class="breadcrumb-item active">Poli</li>
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
            <h3 class="card-title">Data Poli</h3>

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
                  <th>No</th>
                  <th>ID</th>
                  <th>Nama Poli</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>

                <?php
                include '../../koneksi.php';
                $result = mysqli_query($mysqli, "SELECT * FROM poli");
                $no = 1;
                while ($data = mysqli_fetch_assoc($result)) :
                ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['id'] ?></td>
                    <td><?php echo $data['nama_poli'] ?></td>
                    <td><?php echo $data['keterangan'] ?></td>
                    <td>
                      <button type='button' class='btn btn-sm btn-warning edit-btn' data-obatid=<?php echo $data['id'] ?>>Edit</button>
                      <a href='pages/poli/hapusPoli.php?id=<?php echo $data['id'] ?>' class='btn btn-sm btn-danger' onclick='return confirm("Apakah anda ingin menghapus?");'>Hapus</a>
                    </td>

                  </tr>

                <?php endwhile; ?>

              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

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
        <form action="pages/poli/tambahPoli.php" method="post">
          <div class="form-group">
            <label for="nama_obat">Nama Poli</label>
            <input type="text" class="form-control" id="nama_poli" name="nama_poli" required>
          </div>
          <div class="form-group">
            <label for="kemasan">Keterangan</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
          </div>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
      </div>
    </div>
  </div>
</div>