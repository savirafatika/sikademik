<!-- modal sub menu -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalMapel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Mata Pelajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-body">
          <div id="isEdit"></div>
          <div class="form-group">
            <input type="text" class="form-control" id="nama_mapel" name="nama_mapel"
              placeholder="Ketikkan nama mata pelajaran">
          </div>
          <div class="form-group">
            <div class="section-title">Grup Mata Pelajaran</div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="grup_a" name="grup" value="A" class="custom-control-input">
              <label class="custom-control-label" for="grup_a">Kelompok A (Wajib)</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="grup_b" name="grup" value="B" class="custom-control-input">
              <label class="custom-control-label" for="grup_b">Kelompok B (Mulok)</label>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-primary btn-shadow" id="btnSimpanMapel">Simpan</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- modal hapus mapel -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalHapusMapel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Mapel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus mata pelajaran <b><span id="nama_mapel_del"></span></b>?</p>
        <input type="hidden" name="id_mapel_delete">
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-primary btn-shadow" id="btn_delete_mapel">Hapus</button>
      </div>
    </div>
  </div>
</div>