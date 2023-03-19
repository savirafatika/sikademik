<!-- modal sub menu -->
<div class="modal fade" tabindex="-1" role="dialog" id="nilaiModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Nilai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-body">
          <div id="isEdit"></div>
          <div class="form-group">
            <select name="tahun_id" id="tahun_id" class="form-control">
              <option value="" disabled selected>Pilih Tahun Ajaran</option>
              <?php foreach ($tahun as $t): ?>
              <option value="<?=$t['id'];?>"><?=$t['tahun'];?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="form-group">
            <select name="mapel_id" id="mapel_id" class="form-control">
              <option value="" disabled selected>Pilih Mata Pelajaran</option>
              <?php foreach ($mapel as $value): ?>
              <option value="<?=$value['id'];?>"><?=$value['nama_mapel'];?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="form-group">
            <select name="guru_id" id="guru_id" class="form-control">
              <option value="" disabled selected>Pilih Guru</option>
              <?php foreach ($guru as $value): ?>
              <option value="<?=$value['NIP'];?>"><?=$value['nama'];?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="form-group">
            <select name="hari_id" id="hari_id" class="form-control">
              <option value="" disabled selected>Pilih Hari</option>
              <?php foreach ($hari as $value): ?>
              <option value="<?=$value['id'];?>"><?=$value['nama_hari'];?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="jam" name="jam" placeholder="Cth: 07:30-08:30">
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-primary btn-shadow" id="btnSimpanNilai">Simpan</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- modal hapus nilai -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalHapusNilai">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Nilai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus nilai ini?</p>
        <input type="hidden" name="id_nilai_delete">
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-primary btn-shadow" id="btn_delete_nilai">Hapus</button>
      </div>
    </div>
  </div>
</div>