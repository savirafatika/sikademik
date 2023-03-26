<!-- modal sub menu -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalTahun">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Tahun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-body">
          <div id="isEdit"></div>
          <div class="form-group">
            <input
              onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57)) && this.value.length<4"
              type="text" class="form-control" id="tahun" name="tahun" placeholder="Ketikkan nama tahun">
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-primary btn-shadow" id="btnSimpanTahun">Simpan</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- modal hapus tahun -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalHapusTahun">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Tahun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus tahun <b><span id="tahun_del"></span></b>?</p>
        <input type="hidden" name="id_tahun_delete">
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-primary btn-shadow" id="btn_delete_tahun">Hapus</button>
      </div>
    </div>
  </div>
</div>