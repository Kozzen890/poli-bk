<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="container">
        <div class="header">
          <h2 style="text-align: center">Biodata Dokter <br><?php echo $nama; ?></h2>
        </div>
        <div class="content">
          <?php
          include '../../koneksi.php';
          $query = "SELECT * FROM dokter WHERE nama = '$nama'";

          $result = mysqli_query($mysqli, $query);

          $dokter = mysqli_fetch_assoc($result);
          ?>
          <a class="muted-text">Nama</a><br>
          <a><?= $dokter['nama']; ?></a>
          <br>
          <a class="muted-text">Alamat</a><br>
          <a><?= $dokter['alamat']; ?></a>
          <br>
          <a class="muted-text">Nomor HP</a><br>
          <span class="badge-green"><?= $dokter['no_hp']; ?></span>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>