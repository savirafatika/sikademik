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
              <img src="<?php echo base_url(); ?>assets/img/stisla-fill.svg" alt="logo" width="100"
                class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>Change your password for <?= $this->session->userdata('reset_email'); ?></h4>
              </div>
              <?= $this->session->flashdata('message'); ?>

              <div class="card-body">
                <form method="POST" action="<?= base_url('auth/changepassword'); ?>">
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password1">Password Baru</label>
                      <input id="password1" type="password"
                        class="form-control pwstrength <?= form_error('password1', 'is-invalid '); ?>"
                        data-indicator="pwindicator" name="password1">
                      <div class="invalid-feedback">
                        <?= form_error('password1'); ?>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2">Konfirmasi Password</label>
                      <input id="password2" type="password"
                        class="form-control <?= form_error('password2', 'is-invalid '); ?>" name="password2">
                      <div class="invalid-feedback">
                        <?= form_error('password2'); ?>
                      </div>
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
            <div class="simple-footer">
              Copyright &copy; SIKADEMIK <?= date("Y"); ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php $this->load->view('pages/_partials/js'); ?>