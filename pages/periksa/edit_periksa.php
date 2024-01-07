<?php
include '../../koneksi.php';

if (isset($_GET['id']) && $_GET['id'] != null) {
  // Get Data Pasien
  $id = $_GET['id'];
  $query = "SELECT
              periksa.id AS id_periksa,
              periksa.tgl_periksa AS tanggal_periksa,
              periksa.catatan AS catatan,
              pasien.id AS id_pasien,
              pasien.nama AS nama_pasien
              FROM daftar_poli
              INNER JOIN pasien ON pasien.id = daftar_poli.id_pasien
              INNER JOIN periksa ON periksa.id_daftar_poli = $id
              WHERE daftar_poli.id = $id
              ";
  $result = mysqli_query($mysqli, $query);
  $data = mysqli_fetch_assoc($result);
} else {
  header('Location: ./home_periksa.php');
  exit();
}
?>


<div class="modal fade" id="editModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data Periksa Pasien</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editForm" action="<?= $id != "" ? "../../pages/periksa/update_periksa.php?id=$id" : null ?>" method="POST">
          <input type="hidden" name="id" id="id" value="<?= $id; ?>">
          <div class="form-group">
            <label for="nama_pasien">Nama Pasien</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama_pasien'] ?>" required readonly>
          </div>
          <div class="form-group">
            <label for="tgl_periksa">Tanggal Periksa</label>
            <input type="datetime-local" class="form-control" id="tgl_periksa" name="tgl_periksa" value="<?= $data['tanggal_periksa'] ?>" required>
          </div>
          <div class="form-group">
            <label for="catatan">Catatan</label>
            <textarea class="form-control" id="catatan" name="catatan" required><?= $data['catatan'] ?></textarea>
          </div>
          <div class="form-group">
            <select name="obat[]" id="obat" class="form-control" style="width: 100%;" multiple="multiple">
              <optgroup label="Pilih Obat">
                <?php
                $id_periksa = $data['id_periksa'];
                $query_detail_obat = "SELECT id_obat FROM detail_periksa WHERE id_periksa = $id_periksa";
                $db_detail_obat = mysqli_query($mysqli, $query_detail_obat);

                $selected_obats = array();

                while ($row = mysqli_fetch_assoc($db_detail_obat)) {
                  $selected_obats[] = $row['id_obat'];
                }

                $query_obat = "SELECT * FROM obat";
                $db_obat = mysqli_query($mysqli, $query_obat);
                ?>
                <?php while ($obat = mysqli_fetch_assoc($db_obat)) : ?>
                  <?php
                  $obat_id = $obat['id'];
                  $obat_nama = $obat['nama_obat'];
                  $obat_kemasan = $obat['kemasan'];
                  $obat_harga = $obat['harga'];
                  $is_selected = in_array($obat_id, $selected_obats);
                  $selected_attribute = $is_selected ? 'selected' : '';
                  ?>
                  <option value="<?= $obat_id ?>" <?= $selected_attribute ?>>
                    <?= $obat_nama ?> - <?= $obat_kemasan ?> - <?= $obat_harga ?>
                  </option>
                <?php endwhile; ?>
              </optgroup>
            </select>
          </div>

          <input type="submit" name="submit" value="Update" class="btn btn-primary">
        </form>
        <script>
          $('#obat').on('change', function() {
            // Ambil data yang dipilih dari elemen select
            var selectedObat = $(this).val();

            // Tampilkan data yang dipilih dalam input teks
            if (selectedObat && selectedObat.length > 0) {
              $('#selectedObat').val(selectedObat.join(', '));
              $('#selectedObat').css('color', 'black');
            } else {
              $('#selectedObat').val('');
              $('#selectedObat').css('color', 'black');
            }

            // Update nilai elemen input tersembunyi untuk menyimpan data yang dipilih
            $('#selectedObatHidden').val(selectedObat.join(', '));
          });
          $(document).ready(function() {
            $('#obat').select2({
              placeholder: "Pilih Obat",
              allowClear: true,
              templateSelection: function(data, container) {
                // Mengubah warna teks ketika dipilih
                $(container).css("color", "black");
                return data.text;
              }
            });
          });
        </script>
      </div>
    </div>
  </div>
</div>