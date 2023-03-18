<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Mata Pelajaran</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard');?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="<?=base_url('mapel');?>">Mata Pelajaran</a></div>
        <div class="breadcrumb-item">List</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Data Mata Pelajaran <code>Kelas: <?=$kelas['nama_kelas'];?></code> </h4>
              <a href="<?=base_url('mapel');?>" class="btn btn-round btn-secondary"><i class="fas fa-arrow-left"></i>
                Kembali</a>
            </div>
            <div class="card-body">
              <a href="javascript:void(0);" class="btn btn-primary mb-3" id="newMapelModal">Tambah Mata Pelajaran</a>
              <div class="table-responsive">
                <table class="table table-striped" id="table-mapel">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kelas</th>
                      <th>Nama</th>
                      <th>Grup</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="show_data">
                    <?php $i = 1;?>
                    <?php foreach ($mapel as $m): ?>
                    <tr>
                      <td><?=$i;?></td>
                      <td><?=$m['nama_kelas'];?></td>
                      <td><?=$m['nama_mapel'];?></td>
                      <td>Kelompok <?=$m['grup'];?> <?= $m['grup'] === 'A' ? '(Wajib)' : '(Mulok)'; ?></td>
                      <td>
                        <a data-id-mapel="<?=$m['id'];?>" data-nama-mapel="<?=$m['nama_mapel'];?>"
                          data-kelas-id="<?=$m['kelas_id'];?>" data-nama-kelas="<?=$m['nama_kelas'];?>"
                          data-grup="<?=$m['grup'];?>" href="javascript:void(0);"
                          class="item_edit_mapel badge badge-success"><i class="fas fa-edit"></i>
                          Edit</a>
                        <a data-id-mapel="<?=$m['id'];?>" data-nama-mapel="<?=$m['nama_mapel'];?>"
                          href="javascript:void(0);" class="item_delete_mapel badge badge-danger"><i
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
<?php $this->load->view('pages/_partials/modals/mapel');?>
<?php $this->load->view('pages/_partials/footer');?>