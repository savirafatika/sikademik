<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="page-error">
          <div class="page-inner">
            <h1>403</h1>
            <div class="page-description">
              You do not have access to this page.
            </div>
            <div class="text-center">
              <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
              <a href="<?= base_url('dashboard'); ?>">&larr; Back to Dashboard</a>
            </div>
          </div>
        </div>
        <div class="simple-footer mt-5">
          Copyright &copy; SIKADEMIK <?= date("Y"); ?>
        </div>
      </div>
    </section>
  </div>

  <?php $this->load->view('pages/_partials/js'); ?>