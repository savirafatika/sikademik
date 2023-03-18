<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tahun</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard');?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="">Tahun</a></div>
        <div class="breadcrumb-item">List</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Data Tahun</h4>
            </div>
            <div class="card-body">
              <a href="javascript:void(0);" class="btn btn-primary mb-3" id="newTahunModal">Tambah Tahun</a>
              <div class="table-responsive">
                <table class="table table-striped" id="table-tahun">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tahun Ajaran</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="show_data">
                    <?php $i = 1;?>
                    <?php foreach ($tahun as $m): ?>
                    <tr>
                      <td><?=$i;?></td>
                      <td><?=$m['tahun'];?></td>
                      <td>
                        <a data-id-tahun="<?=$m['id'];?>" data-tahun="<?=$m['tahun'];?>" href="javascript:void(0);"
                          class="item_edit_tahun badge badge-success"><i class="fas fa-edit"></i>
                          Edit</a>
                        <a data-id-tahun="<?=$m['id'];?>" data-tahun="<?=$m['tahun'];?>" href="javascript:void(0);"
                          class="item_delete_tahun badge badge-danger"><i class="fas fa-trash"></i>
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
<?php $this->load->view('pages/_partials/modals/tahun');?>
<?php $this->load->view('pages/_partials/footer');?>