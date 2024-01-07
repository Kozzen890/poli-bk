<?php include '../../koneksi.php' ?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Riwayat Pasien</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="dashboard.php?page=home">Home</a></li>
          <li class="breadcrumb-item active">Poliklinik</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Riwayat Pasien</h3>
          </div>
          <!-- /.card-header -->


          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>Nomor</th>
                  <th>Nama Pasien</th>
                  <th>Alamat</th>
                  <th>No. KTP</th>
                  <th>No. HP</th>
                  <th>No. RM</th>
                  <th width="10%"><i class="fas fa-cog"></i></th>
                </tr>
              </thead>
              <tbody>
                <?php

                $nomor = 1;
                $query =
                  "SELECT * FROM pasien";
                $results = $mysqli->query($query);

                if ($results->num_rows == 0) {
                  echo "<tr><td colspan='7' align='center'>Tidak ada data</td></tr>";
                } else {
                  while ($d = $results->fetch_assoc()) {
                ?>
                    <tr>
                      <td><?= $nomor++; ?></td>
                      <td><?= $d['nama']; ?></td>
                      <td><?= $d['alamat']; ?></td>
                      <td><?= $d['no_ktp']; ?></td>
                      <td><?= $d['no_hp']; ?></td>
                      <td><?= $d['no_rm']; ?></td>
                      <td>
                        <button data-toggle="modal" data-target="#detailModal<?= $d['id'] ?>" class="btn btn-info btn-sm">
                          <i class="fa fa-eye"></i> Detail Riwayat <br>Periksa
                        </button>
                      </td>
                    </tr>
                <?php
                  }
                }
                ?>
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

<?php
$results->data_seek(0);
while ($d = $results->fetch_assoc()) {
  $no_detail = 1;
  $pasien_id = $d['id'];
  $data2 = $mysqli->query("SELECT 
                p.nama AS 'nama_pasien',
                pr.*,
                d.nama AS 'nama_dokter',
                dpo.keluhan AS 'keluhan',
                GROUP_CONCAT(o.nama_obat, ' | ', o.kemasan , ' | ', o.harga SEPARATOR ', ') AS 'obat'
                FROM periksa pr
                LEFT JOIN daftar_poli dpo ON (pr.id_daftar_poli = dpo.id)
                LEFT JOIN jadwal_periksa jp ON (dpo.id_jadwal = jp.id)
                LEFT JOIN dokter d ON (jp.id_dokter = d.id)
                LEFT JOIN pasien p ON (dpo.id_pasien = p.id)
                LEFT JOIN detail_periksa dp ON (pr.id = dp.id_periksa)
                LEFT JOIN obat o ON (dp.id_obat = o.id)
                WHERE dpo.id_pasien = '$pasien_id'
                GROUP BY pr.id
                ORDER BY pr.tgl_periksa DESC;");
?>
  <div class="modal fade" id="detailModal<?= $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Riwayat <?= $d['nama'] ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php if ($data2->num_rows == 0) : ?>
            <p class="my-2 text-danger">Tidak Ditemukan Riwayat Periksa</p>
          <?php else : ?>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Tanggal Periksa</th>
                  <th scope="col">Nama Pasien</th>
                  <th scope="col">Nama Dokter</th>
                  <th scope="col">Keluhan</th>
                  <th scope="col">Catatan</th>
                  <th scope="col">Obat</th>
                  <th scope="col">Total Biaya</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($da = $data2->fetch_assoc()) : ?>
                  <tr>
                    <td><?= $no_detail++; ?></td>
                    <td><?= $da['tgl_periksa']; ?></td>
                    <td><?= $da['nama_pasien']; ?></td>
                    <td><?= $da['nama_dokter']; ?></td>
                    <td><?= $da['keluhan']; ?></td>
                    <td><?= $da['catatan']; ?></td>
                    <td><?= $da['obat']; ?></td>
                    <td><?= $da['biaya_periksa']; ?></td>
                  </tr>
                <?php endwhile ?>
              </tbody>
            </table>
          <?php endif ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>