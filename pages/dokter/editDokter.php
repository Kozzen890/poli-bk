<?php
include("../../koneksi.php");

$id = $_GET['id']; //mengambil id user yang ingin diubah

//menampilkan user berdasarkan id
$data = mysqli_query($mysqli, "select * from dokter where id = '$id'");
$row = mysqli_fetch_assoc($data);
?>

<!-- Modal -->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="pages/dokter/updateDokter.php">
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <div class="form-group">
                        <label for="nama">Nama Dokter</label>
                        <input type="text" class="form-control" id="nama_poli" name="nama" value="<?= $row['nama']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $row['alamat']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">Nomor HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $row['no_hp']; ?>" required>
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

                    <input type="submit" name="submit" value="Update" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>