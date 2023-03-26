<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Sub Menu</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard');?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="">Sub Menu</a></div>
        <div class="breadcrumb-item">List</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Daftar Sub Menu</h4>
            </div>
            <div class="card-body">
              <a href="javascript:void(0);" class="btn btn-primary mb-3" id="newSubMenuModal">Tambah Sub Menu</a>
              <div class="table-responsive">
                <table class="table table-striped" id="table-submenu">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Menu</th>
                      <th>Url</th>
                      <th>Icon</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="show_data">
                    <?php $i = 1;?>
                    <?php foreach ($subMenu as $sm): ?>
                    <tr>
                      <td><?=$i;?></td>
                      <td><?=$sm['title'];?></td>
                      <td><?=$sm['menu'];?></td>
                      <td><?=$sm['url'];?></td>
                      <td><?=$sm['icon'];?></td>
                      <td><?=$sm['is_active'] == 1 ? 'Aktif' : 'Tidak Aktif';?></td>
                      <td>
                        <a data-id-menu="<?=$sm['id'];?>" data-title="<?=$sm['title'];?>"
                          data-url="<?=$sm['url'];?>" data-icon="<?=$sm['icon'];?>"
                          data-menu-id="<?=$sm['menu_id'];?>" data-status="<?=$sm['is_active'];?>"
                          href="javascript:void(0);" class="item_edit badge badge-success"><i class="fas fa-edit"></i>
                          Edit</a>
                        <a data-id-menu="<?=$sm['id'];?>" data-title="<?=$sm['title'];?>"
                          data-url="<?=$sm['url'];?>" data-icon="<?=$sm['icon'];?>"
                          data-menu-id="<?=$sm['menu_id'];?>" data-status="<?=$sm['is_active'];?>"
                          href="javascript:void(0);" class="item_delete badge badge-danger"><i class="fas fa-trash"></i>
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
<?php $this->load->view('pages/_partials/modals/sub-menu');?>
<?php $this->load->view('pages/_partials/footer');?>