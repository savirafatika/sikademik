<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Daftar Kelas</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard');?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="">Data Siswa</a></div>
        <div class="breadcrumb-item">List</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Daftar Kelas</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-siswa-kelas">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Kelas</th>
                      <th>Jumlah Siswa</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="show_data">
                    <?php $i = 1;?>
                    <?php foreach ($daftar_kelas as $dk): ?>
                    <tr>
                      <td><?=$i;?></td>
                      <td><?=$dk['nama_kelas'];?></td>
                      <td><?=count_siswa_kelas($dk['id']);?></td>
                      <td>
                        <a data-id-kelas="<?=$dk['id'];?>" data-nama-kelas="<?=$dk['nama_kelas'];?>"
                          href="javascript:void(0);" class="item_lihat_siswa badge badge-info"><i
                            class="fas fa-eye"></i>
                          Lihat Siswa</a>
                      </td>
                    </tr>
                    <?php $i++;?>
                    <?php endforeach;?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('pages/_partials/footer');?>