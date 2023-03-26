<form class="modal-part" id="modal-menu">
  <div class="form-group">
    <label>Nama Menu</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <input type="text" class="form-control" placeholder="Masukkan nama menu" name="menu">
    </div>
  </div>
</form>

<!-- modal edit menu -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEditMenu">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label>Nama Menu</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-bars"></i>
                </div>
              </div>
              <input type="text" class="form-control" placeholder="Masukkan nama menu" name="menu">
            </div>
          </div>
          <input type="hidden" name="id_menu">
        </form>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-primary btn-shadow" id="btnSimpan">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- modal hapus menu -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalHapusMenu">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus menu <b><span id="nama_menu"></span></b>?</p>
        <input type="hidden" name="id_menu_delete">
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-primary btn-shadow" id="btnDelete">Hapus</button>
      </div>
    </div>
  </div>
</div>