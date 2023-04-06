<!-- modal tambah & edit -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalGuru">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Guru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-body">
          <div id="isEdit"></div>
          <div class="form-group">
            <input
              onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57)) && this.value.length<18"
              type="text" class="form-control" id="nip" name="nip" placeholder="Ketikkan NIP guru">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Ketikkan nama guru">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
              placeholder="Ketikkan tempat lahir guru">
          </div>
          <div class="form-group">
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
              placeholder="Tanggal lahir guru">
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
            <select name="status_perkawinan" id="status_perkawinan" class="form-control">
              <option value="" disabled selected>Pilih Status Perkawinan</option>
              <option value="Belum Kawin">Belum Kawin</option>
              <option value="Kawin">Kawin</option>
              <option value="Cerai Hidup">Cerai Hidup</option>
              <option value="Cerai Mati">Cerai Mati</option>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="nama_perguruan_tinggi" name="nama_perguruan_tinggi"
              placeholder="Nama Perguruan Tinggi">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Nama Jurusan">
          </div>
          <div class="form-group">
            <input
              onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57)) && this.value.length<4"
              type="text" class="form-control" id="tahun_lulus" name="tahun_lulus" placeholder="Tahun Lulus">
          </div>
          <div class="form-group">
            <select name="golongan" id="golongan" class="form-control">
              <option value="" disabled selected>Pilih Golongan</option>
              <option value="Golongan IA">Golongan IA</option>
              <option value="Golongan IB">Golongan IB</option>
              <option value="Golongan IC">Golongan IC</option>
              <option value="Golongan ID">Golongan ID</option>
              <option value="Golongan IIA">Golongan IIA</option>
              <option value="Golongan IIB">Golongan IIB</option>
              <option value="Golongan IIC">Golongan IIC</option>
              <option value="Golongan IID">Golongan IID</option>
              <option value="Golongan IIIA">Golongan IIIA</option>
              <option value="Golongan IIIB">Golongan IIIB</option>
              <option value="Golongan IIIC">Golongan IIIC</option>
              <option value="Golongan IIID">Golongan IIID</option>
              <option value="Golongan IVA">Golongan IVA</option>
              <option value="Golongan IVB">Golongan IVB</option>
              <option value="Golongan IVC">Golongan IVC</option>
              <option value="Golongan IVD">Golongan IVD</option>
              <option value="Golongan IVE">Golongan IVE</option>
              <option value="Lain-lain">Lain-lain</option>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="cth: PNS, Honor...">
          </div>
          <div class="form-group">
            <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control"
              placeholder="Ketikkan alamat guru"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-primary btn-shadow" id="btnSimpanGuru">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- modal hapus guru -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalHapusGuru">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Guru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus guru <b><span id="nama_guru"></span></b>?</p>
        <input type="hidden" name="id_guru_delete">
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-primary btn-shadow" id="btn_delete_guru">Hapus</button>
      </div>
    </div>
  </div>
</div>
