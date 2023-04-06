<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Input Nilai Siswa</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard');?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="<?=base_url('nilai');?>">Nilai</a></div>
        <div class="breadcrumb-item">Input</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Form Input Nilai</h4>
            </div>
            <?=$this->session->flashdata('message');?>
            <div class="card-body">
              <form action="<?=base_url('nilai/input');?>" method="POST">
                <div class="form-group">
                  <select name="kelas_id" id="kelas_id"
                    class="form-control <?=form_error('kelas_id', 'is-invalid ');?>">
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
                  <select name="tahun_id" id="tahun_id"
                    class="form-control <?=form_error('tahun_id', 'is-invalid ');?>">
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
                  <select name="semester" id="semester"
                    class="form-control <?=form_error('semester', 'is-invalid ');?>">
                    <option value="" disabled selected>Pilih Semester</option>
                    <option value="I">I</option>
                    <option value="II">II</option>
                  </select>
                  <div class="invalid-feedback">
                    <?=form_error('semester');?>
                  </div>
                </div>
                <div class="form-group">
                  <select name="mapel_id" id="mapel_id"
                    class="form-control <?=form_error('mapel_id', 'is-invalid ');?>">
                    <option value="" disabled selected>Pilih Mata Pelajaran</option>
                  </select>
                  <div class="invalid-feedback">
                    <?=form_error('mapel_id');?>
                  </div>
                </div>
                <div class="form-group">
                  <select name="siswa_id" id="siswa_id"
                    class="form-control <?=form_error('siswa_id', 'is-invalid ');?>">
                    <option value="" disabled selected>Pilih Siswa</option>
                  </select>
                  <div class="invalid-feedback">
                    <?=form_error('siswa_id');?>
                  </div>
                </div>
                <div class="form-group">
                  <select name="spiritual" id="spiritual"
                    class="form-control <?=form_error('spiritual', 'is-invalid ');?>">
                    <option value="" disabled selected>Nilai Sikap Spiritual (K-1)</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                  </select>
                  <div class="invalid-feedback">
                    <?=form_error('spiritual');?>
                  </div>
                </div>
                <div class="form-group">
                  <select name="sosial" id="sosial" class="form-control <?=form_error('sosial', 'is-invalid ');?>">
                    <option value="" disabled selected>Nilai Sikap Sosial (K-2)</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                  </select>
                  <div class="invalid-feedback">
                    <?=form_error('sosial');?>
                  </div>
                </div>
                <div class="form-group">
                  <input
                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57)) && this.value.length<3"
                    type="text" class="form-control <?=form_error('nilai_pengetahuan', 'is-invalid ');?>"
                    id="nilai_pengetahuan" name="nilai_pengetahuan" placeholder="Nilai Pengetahuan (KI-3)">
                  <div class="invalid-feedback">
                    <?=form_error('nilai_pengetahuan');?>
                  </div>
                </div>
                <div class="form-group">
                  <input
                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57)) && this.value.length<3"
                    type="text" class="form-control <?=form_error('nilai_keterampilan', 'is-invalid ');?>"
                    id="nilai_keterampilan" name="nilai_keterampilan" placeholder="Nilai Keterampilan (KI-4)">
                  <div class="invalid-feedback">
                    <?=form_error('nilai_keterampilan');?>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary btn-shadow" id="">Simpan</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('pages/_partials/footer');?>