<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Kelas</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard');?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="">Kelas</a></div>
        <div class="breadcrumb-item">List</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Data Kelas</h4>
            </div>
            <div class="card-body">
              <a href="javascript:void(0);" class="btn btn-primary mb-3" id="newKelasModal">Tambah Kelas</a>
              <div class="table-responsive">
                <table class="table table-striped" id="table-kelas">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="show_data">
                    <?php $i = 1;?>
                    <?php foreach ($kelas as $m): ?>
                    <tr>
                      <td><?=$i;?></td>
                      <td><?=$m['nama_kelas'];?></td>
                      <td>
                        <a data-id-kelas="<?=$m['id'];?>" data-nama-kelas="<?=$m['nama_kelas'];?>"
                          href="javascript:void(0);" class="item_edit_kelas badge badge-success"><i
                            class="fas fa-edit"></i>
                          Edit</a>
                        <a data-id-kelas="<?=$m['id'];?>" data-nama-kelas="<?=$m['nama_kelas'];?>"
                          href="javascript:void(0);" class="item_delete_kelas badge badge-danger"><i
                            class="fas fa-trash"></i>
                          Delete</a>
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
<?php $this->load->view('pages/_partials/modals/kelas');?>
<?php $this->load->view('pages/_partials/footer');?>