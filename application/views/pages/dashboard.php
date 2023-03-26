<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-user-tie"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Guru</h4>
            </div>
            <div class="card-body">
              <?= $total_guru; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="fas fa-users"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Siswa</h4>
            </div>
            <div class="card-body">
              <?= $total_siswa; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-book-open"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Mapel</h4>
            </div>
            <div class="card-body">
              <?= $total_mapel; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-user-cog"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Staff TU</h4>
            </div>
            <div class="card-body">
              <?= $total_staff; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('pages/_partials/footer'); ?>