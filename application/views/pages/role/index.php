<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Level Pengguna</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="">Level Pengguna</a></div>
        <div class="breadcrumb-item">List</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Daftar Level Pengguna</h4>
            </div>
            <div class="card-body">
              <a href="" class="btn btn-primary mb-3" id="newRoleModal">Tambah Level Pengguna</a>
              <div class="table-responsive">
                <table class="table table-striped" id="table-role">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Level Pengguna</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($role as $m) : ?>
                      <tr>
                        <td>
                          <?= $i; ?>
                        </td>
                        <td>
                          <?= $m['role']; ?>
                        </td>
                        <td>
                          <a data-id-role="<?= $m['id']; ?>" data-role="<?= $m['role']; ?>" href="#" class="modal-role badge badge-success"><i class="fas fa-edit"></i> Edit</a>
                          <a data-id-role="<?= $m['id']; ?>" data-role="<?= $m['role']; ?>" href="#" class="modal-delete-role badge badge-danger"><i class="fas fa-trash"></i> Delete</a>
                        </td>
                      </tr>
                      <?php $i++; ?>
                    <?php endforeach; ?>
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
<?php $this->load->view('pages/_partials/modals/role'); ?>
<?php $this->load->view('pages/_partials/footer'); ?>