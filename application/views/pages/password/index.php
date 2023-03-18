<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Ganti Password</h1>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card card-primary">
          <div class="card-header">
            <?= $this->session->flashdata('message'); ?>
          </div>

          <div class="card-body">
            <form method="POST" action="<?= base_url('password'); ?>">
              <div class="form-group">
                <label for="old_password">Password Sebelumnya</label>
                <input id="old_password" type="password" class="form-control" name="old_password" tabindex="1" required
                  autofocus value="<?= set_value('old_password'); ?>">
                <div class="invalid-feedback">
                  <?= form_error('old_password', '<small class="text-danger pl-3">', '</small>') ?: 'Masukkan old_password'; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="password1">Password Baru</label>
                <input id="password1" type="password"
                  class="form-control pwstrength <?= form_error('password1', 'is-invalid '); ?>"
                  data-indicator="pwindicator" name="password1" tabindex="2" required>
                <div class="invalid-feedback">
                  <?= form_error('password1'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="password2">Konfirmasi Password</label>
                <input id="password2" type="password"
                  class="form-control <?= form_error('password2', 'is-invalid '); ?>" name="password2" tabindex="3"
                  required>
                <div class="invalid-feedback">
                  <?= form_error('password2'); ?>
                </div>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                  Ubah Password
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('pages/_partials/footer'); ?>