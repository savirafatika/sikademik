<!-- modal sub menu -->
<div class="modal fade" tabindex="-1" role="dialog" id="nilaiModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Nilai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-body">
          <div id="isEdit"></div>
          <form action="<?=base_url('nilai/input');?>" method="POST">
            <!-- <div class="form-group">
              <select name="kelas_id" id="kelas_id" class="form-control <?=form_error('kelas_id', 'is-invalid ');?>">
                <option value="" disabled selected>Pilih Kelas</option>
                <?php foreach ($kelas as $t): ?>
                <option value="<?=$t['id'];?>"><?=$t['nama_kelas'];?></option>
                <?php endforeach;?>
              </select>
              <div class="invalid-feedback">
                <?=form_error('kelas_id');?>
              </div>
            </div>
            <div class="form-group">
              <select name="tahun_id" id="tahun_id" class="form-control <?=form_error('tahun_id', 'is-invalid ');?>">
                <option value="" disabled selected>Pilih Tahun Ajaran</option>
                <?php foreach ($tahun as $t): ?>
                <option value="<?=$t['id'];?>"><?=$t['tahun'];?></option>
                <?php endforeach;?>
              </select>
              <div class="invalid-feedback">
                <?=form_error('tahun_id');?>
              </div>
            </div>
            <div class="form-group">
              <select name="semester" id="semester" class="form-control <?=form_error('semester', 'is-invalid ');?>">
                <option value="" disabled selected>Pilih Semester</option>
                <option value="I">I</option>
                <option value="II">II</option>
              </select>
              <div class="invalid-feedback">
                <?=form_error('semester');?>
              </div>
            </div>
            <div class="form-group">
              <select name="mapel_id" id="mapel_id" class="form-control <?=form_error('mapel_id', 'is-invalid ');?>">
                <option value="" disabled selected>Pilih Mata Pelajaran</option>
                <?php foreach ($mapel as $item): ?>
                <option value="<?=$item['id'];?>"><?=$item['nama_mapel'];?></option>
                <?php endforeach;?>
              </select>
              <div class="invalid-feedback">
                <?=form_error('mapel_id');?>
              </div>
            </div>
            <div class="form-group">
              <select name="siswa_id" id="siswa_id" class="form-control <?=form_error('siswa_id', 'is-invalid ');?>">
                <option value="" disabled selected>Pilih Siswa</option>
                <?php foreach ($siswa as $item): ?>
                <option value="<?=$item['NIS'];?>"><?=$item['nama'];?></option>
                <?php endforeach;?>
              </select>
              <div class="invalid-feedback">
                <?=form_error('siswa_id');?>
              </div>
            </div> -->
            <div class="form-group">
              <label for="spiritual">
                Nilai Sikap Spiritual (K-1)
                <select name="spiritual" id="spiritual"
                  class="form-control <?=form_error('spiritual', 'is-invalid ');?>">
                  <option value="" disabled selected>Nilai Sikap Spiritual (K-1)</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                  <option value="E">E</option>
                </select>
              </label>
              <div class="invalid-feedback">
                <?=form_error('spiritual');?>
              </div>
            </div>
            <div class="form-group">
              <label for="sosial">
                Nilai Sikap Sosial (K-2)
                <select name="sosial" id="sosial" class="form-control <?=form_error('sosial', 'is-invalid ');?>">
                  <option value="" disabled selected>Nilai Sikap Sosial (K-2)</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                  <option value="E">E</option>
                </select>
              </label>
              <div class="invalid-feedback">
                <?=form_error('sosial');?>
              </div>
            </div>
            <div class="form-group">
              <label for="nilai_pengetahuan">
                Nilai Pengetahuan (KI-3)
                <input
                  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57)) && this.value.length<3"
                  type="text" class="form-control <?=form_error('nilai_pengetahuan', 'is-invalid ');?>"
                  id="nilai_pengetahuan" name="nilai_pengetahuan" placeholder="Nilai Pengetahuan (KI-3)">
              </label>
              <div class="invalid-feedback">
                <?=form_error('nilai_pengetahuan');?>
              </div>
            </div>
            <div class="form-group">
              <label for="nilai_keterampilan">Nilai Keterampilan (KI-4)
                <input
                  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57)) && this.value.length<3"
                  type="text" class="form-control <?=form_error('nilai_keterampilan', 'is-invalid ');?>"
                  id="nilai_keterampilan" name="nilai_keterampilan" placeholder="Nilai Keterampilan (KI-4)">
              </label>
              <div class="invalid-feedback">
                <?=form_error('nilai_keterampilan');?>
              </div>
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
        <p>Apakah anda yakin ingin menghapus nilai pada mata pelajaran ini?</p>
        <input type="hidden" name="id_nilai_delete">
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-primary btn-shadow" id="btn_delete_nilai">Hapus</button>
      </div>
    </div>
  </div>
</div>