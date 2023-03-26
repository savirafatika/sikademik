<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="<?php echo base_url(); ?>assets/img/stisla-fill.svg" alt="logo" width="100"
                class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>Lupa Password</h4>
              </div>
              <?= $this->session->flashdata('message'); ?>
              <div class="card-body">
                <p class="text-muted">Sistem akan mengirimkan tautan ke email Anda untuk melakukan atur ulang password
                </p>
                <form method="POST" action="<?= base_url('auth/lupapassword'); ?>">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control <?= form_error('email', 'is-invalid '); ?>"
                      name="email" tabindex="1" required autofocus value="<?= set_value('email'); ?>">
                    <div class="invalid-feedback">
                      <?= form_error('email'); ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Kirim Link
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