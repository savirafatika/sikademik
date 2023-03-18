<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Menu</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard');?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="">Menu</a></div>
        <div class="breadcrumb-item">List</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Daftar Menu</h4>
            </div>
            <div class="card-body">
              <a href="" class="btn btn-primary mb-3" id="newMenuModal">Tambah Menu</a>
              <div class="table-responsive">
                <table class="table table-striped" id="table-menu">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Menu</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;?>
                    <?php foreach ($menu as $m): ?>
                    <tr>
                      <td>
                        <?=$i;?>
                      </td>
                      <td>
                        <?=$m['menu'];?>
                      </td>
                      <td>
                        <a data-id-menu="<?=$m['id'];?>" data-menu="<?=$m['menu'];?>" href="#"
                          class="modal-menu badge badge-success"><i class="fas fa-edit"></i> Edit</a>
                        <a data-id-menu="<?=$m['id'];?>" data-menu="<?=$m['menu'];?>" href="#"
                          class="modal-delete-menu badge badge-danger"><i class="fas fa-trash"></i> Delete</a>
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
<?php $this->load->view('pages/_partials/modals/menu');?>
<?php $this->load->view('pages/_partials/footer');?>