<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Daftar Siswa</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard');?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="<?=base_url('nilai');?>">Nilai</a></div>
        <div class="breadcrumb-item">Daftar Siswa</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Daftar Siswa</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-jadwal-siswa">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Nama Siswa</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="show_data">
                    <?php $i = 1;?>
                    <?php foreach ($daftar_siswa as $dk): ?>
                    <tr>
                      <td><?=$i;?></td>
                      <td><?=$dk['NIS'];?></td>
                      <td><?=$dk['nama'];?></td>
                      <td>
                        <a data-nis-siswa="<?=$dk['NIS'];?>" href="javascript:void(0);"
                          class="item_lihat_nilai_siswa badge badge-info"><i class="fas fa-eye"></i>
                          Lihat Nilai</a>
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