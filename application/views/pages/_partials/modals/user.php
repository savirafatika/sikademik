<!-- modal sub menu -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalUser">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-body">
          <div id="isEdit"></div>
          <div class="form-group">
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Ketikkan nama user">
          </div>
          <div class="form-group">
            <select name="role_id" id="role_id" class="form-control">
              <option value="" disabled selected>Pilih Role</option>
              <?php foreach ($role as $r) : ?>
              <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="email" name="email" placeholder="Ketikkan email user">
          </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
              <label class="form-check-label" for="is_active">
                Status Aktif?
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-primary btn-shadow" id="btnSimpanUser">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- modal hapus user -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalHapusUser">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus user <b><span id="nama_user"></span></b>?</p>
        <input type="hidden" name="id_user_delete">
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-primary btn-shadow" id="btn_delete_user">Hapus</button>
      </div>
    </div>
  </div>
</div>