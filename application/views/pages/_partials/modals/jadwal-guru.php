<!-- modal sub menu -->
<div class="modal fade" tabindex="-1" role="dialog" id="assignJadwalModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pilih Jadwal untuk Guru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-body">
          <div class="form-group">
            <select name="jadwal_id" id="jadwal_id" class="form-control">
              <option value="" disabled selected>Pilih Jadwal</option>
              <?php foreach ($jadwal_kosong as $t): ?>
              <option value="<?=$t['id'];?>"><b>Tahun: <?=$t['tahun'] . ' | Jam Pelajaran: ' . $t['jam'];?></b></option>
              <?php endforeach;?>
            </select>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-primary btn-shadow" id="btnSimpanAturJadwalGuru">Simpan</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- modal hapus jadwal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalHapusJadwalGuru">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Jadwal Guru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus jadwal guru ini?</p>
        <input type="hidden" name="id_jadwal_guru_delete">
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-primary btn-shadow" id="btn_delete_jadwal_guru">Hapus</button>
      </div>
    </div>
  </div>
</div>