<!-- modal sub menu -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalKelas">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-body">
          <div id="isEdit"></div>
          <div class="form-group">
            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Ketikkan nama kelas">
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-primary btn-shadow" id="btnSimpanKelas">Simpan</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- modal hapus kelas -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalHapusKelas">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus kelas <b><span id="nama_kelas_del"></span></b>?</p>
        <input type="hidden" name="id_kelas_delete">
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-primary btn-shadow" id="btn_delete_kelas">Hapus</button>
      </div>
    </div>
  </div>
</div>