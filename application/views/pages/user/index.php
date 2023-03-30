<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Pengguna</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="">Pengguna</a></div>
        <div class="breadcrumb-item">List</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Daftar Pengguna</h4>
            </div>
            <div class="card-body">
              <a href="javascript:void(0);" class="btn btn-primary mb-3" id="newUserModal">Tambah Pengguna</a>
              <div class="table-responsive">
                <table class="table table-striped" id="table-user">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Level Pengguna</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="show_data">
                    <?php $i = 1; ?>
                    <?php foreach ($users as $u) : ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $u['name']; ?></td>
                        <td><?= $u['email']; ?></td>
                        <td><?= $u['role']; ?></td>
                        <td><?= $u['is_active'] == 1 ? 'Aktif' : 'Tidak Aktif'; ?></td>
                        <td>
                          <a data-id-user="<?= $u['id']; ?>" data-nama="<?= $u['name']; ?>" data-email="<?= $u['email']; ?>" data-role-id="<?= $u['role_id']; ?>" data-status="<?= $u['is_active']; ?>" href="javascript:void(0);" class="item_edit_user badge badge-success"><i class="fas fa-edit"></i>
                            Edit</a>
                          <a data-id-user="<?= $u['id']; ?>" data-nama="<?= $u['name']; ?>" href="javascript:void(0);" class="item_delete_user badge badge-danger"><i class="fas fa-trash"></i>
                            Delete</a>
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
<?php $this->load->view('pages/_partials/modals/user'); ?>
<?php $this->load->view('pages/_partials/footer'); ?>