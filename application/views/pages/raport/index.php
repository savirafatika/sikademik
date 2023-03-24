<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Raport Siswa</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard');?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="">Raport</a></div>
        <div class="breadcrumb-item">List</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Pencarian Data</h4>
            </div>
            <div class="card-body">
              <form action="" method="">
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
                <button type="submit" class="btn btn-primary btn-shadow" id="btnCariRaport">Lihat Data</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('pages/_partials/footer');?>