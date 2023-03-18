<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="<?= base_url(); ?>assets/img/stisla-fill.svg" alt="logo" width="100"
                class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>Pendaftaran Akun Wali Siswa/i</h4>
              </div>

              <div class="card-body">
                <form method="POST" action="<?= base_url('auth/registration'); ?>">
                  <div class="form-group">
                    <label for="nis">NIS (Nomor Induk Siswa)</label>
                    <input
                      onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57)) && this.value.length<10"
                      id="nis" type="text" class="form-control <?= form_error('nis', 'is-invalid '); ?>" name="nis"
                      value="<?= set_value('nis'); ?>">
                    <div class="invalid-feedback">
                      <?= form_error('nis'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="full_name">Nama Lengkap Siswa</label>
                    <input id="full_name" type="text" class="form-control <?= form_error('name', 'is-invalid '); ?>"
                      name="name" value="<?= set_value('name'); ?>">
                    <div class="invalid-feedback">
                      <?= form_error('name'); ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control <?= form_error('email', 'is-invalid '); ?>"
                      name="email" value="<?= set_value('email'); ?>">
                    <div class="invalid-feedback">
                      <?= form_error('email'); ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password"
                        class="form-control pwstrength <?= form_error('password1', 'is-invalid '); ?>"
                        data-indicator="pwindicator" name="password1">
                      <div class="invalid-feedback">
                        <?= form_error('password1'); ?>
                      </div>
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Konfirmasi Password</label>
                      <input id="password2" type="password"
                        class="form-control <?= form_error('password2', 'is-invalid '); ?>" name="password2">
                      <div class="invalid-feedback">
                        <?= form_error('password2'); ?>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Daftar Sekarang
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-3 text-muted text-center">
              Sudah punya akun? <a href="<?= base_url('auth'); ?>">Login Sekarang</a>
            </div>
            <div class="simple-footer">
              Copyright &copy; SIKADEMIK <?= date("Y"); ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php $this->load->view('pages/_partials/js'); ?>