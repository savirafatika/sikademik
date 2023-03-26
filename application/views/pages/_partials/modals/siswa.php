<!-- modal sub menu -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalSiswa">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-body">
          <div id="isEdit"></div>
          <div class="form-group">
            <input
              onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57)) && this.value.length<10"
              type="text" class="form-control" id="nis" name="nis" placeholder="Ketikkan NIS siswa">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Ketikkan nama siswa">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
              placeholder="Ketikkan tempat lahir siswa">
          </div>
          <div class="form-group">
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
              placeholder="Tanggal lahir siswa">
          </div>
          <div class="form-group">
            <div class="section-title">Jenis Kelamin</div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="laki_laki" name="jenis_kelamin" value="Laki-laki" class="custom-control-input">
              <label class="custom-control-label" for="laki_laki">Laki-laki</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" class="custom-control-input">
              <label class="custom-control-label" for="perempuan">Perempuan</label>
            </div>
          </div>
          <div class="form-group">
            <select name="agama" id="agama" class="form-control">
              <option value="" disabled selected>Pilih Agama</option>
              <option value="Islam">Islam</option>
              <option value="Protestan">Protestan</option>
              <option value="Katolik">Katolik</option>
              <option value="Hindu">Hindu</option>
              <option value="Buddha">Buddha</option>
              <option value="Khonghucu">Khonghucu</option>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah siswa">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu siswa">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah"
              placeholder="Pekerjaan Ayah siswa">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu"
              placeholder="Pekerjaan Ibu siswa">
          </div>
          <div class="form-group">
            <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control"
              placeholder="Ketikkan alamat siswa"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-primary btn-shadow" id="btnSimpanSiswa">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- modal hapus siswa -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalHapusSiswa">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus siswa <b><span id="nama_siswa"></span></b>?</p>
        <input type="hidden" name="id_siswa_delete">
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-primary btn-shadow" id="btn_delete_siswa">Hapus</button>
      </div>
    </div>
  </div>
</div>
