<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Daftar Guru</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard');?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="">Jadwal Guru</a></div>
        <div class="breadcrumb-item">List Guru</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Daftar Guru</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-jadwal-guru">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIP</th>
                      <th>Nama Guru</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="show_data">
                    <?php $i = 1;?>
                    <?php foreach ($daftar_guru as $dk): ?>
                    <tr>
                      <td><?=$i;?></td>
                      <td><?=$dk['NIP'];?></td>
                      <td><?=$dk['nama'];?></td>
                      <td>
                        <a data-nip-guru="<?=$dk['NIP'];?>" data-nama-guru="<?=$dk['nama'];?>"
                          href="javascript:void(0);" class="item_lihat_jadwal_guru badge badge-info"><i
                            class="fas fa-eye"></i>
                          Lihat Kelas</a>
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