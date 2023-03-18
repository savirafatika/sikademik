<form class="modal-part" id="modal-role">
  <div class="form-group">
    <label>Nama Role</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <input type="text" class="form-control" placeholder="Masukkan nama role" name="role">
    </div>
  </div>
</form>

<!-- modal edit role -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEditRole">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label>Nama Role</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-bars"></i>
                </div>
              </div>
              <input type="text" class="form-control" placeholder="Masukkan nama role" name="role">
            </div>
          </div>
          <input type="hidden" name="id_role">
        </form>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-primary btn-shadow" id="btnSimpan">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- modal hapus role -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalHapusRole">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus role <b><span id="nama_role"></span></b>?</p>
        <input type="hidden" name="id_role_delete">
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-primary btn-shadow" id="btnDelete">Hapus</button>
      </div>
    </div>
  </div>
</div>