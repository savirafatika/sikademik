<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Jadwal Pelajaran</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard');?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="<?=base_url('jadwal');?>">Jadwal</a></div>
        <div class="breadcrumb-item">List</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Jadwal Pelajaran <code>Kelas: <?=$kelas['nama_kelas'];?></code> </h4>
              <a href="<?=base_url('jadwal');?>" class="btn btn-round btn-secondary"><i class="fas fa-arrow-left"></i>
                Kembali</a>
            </div>
            <div class="card-body">
              <a href="javascript:void(0);" class="btn btn-primary mb-3" id="newJadwalModal">Tambah Jadwal</a>
              <div class="table-responsive">
                <table class="table table-striped" id="table-kelas">
                  <thead>
                    <tr>
                      <th class="align-middle text-center">Waktu</th>
                      <th class="align-middle text-center">Hari</th>
                      <th class="align-middle text-center">Mata Pelajaran</th>
                      <th class="align-middle text-center">Guru Pengampu</th>
                      <th class="align-middle text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="show_data">
                    <?php $i = 1;?>
                    <?php foreach ($jadwal as $j): ?>
                    <tr class="text-center">
                      <td><?=$j['jam'];?></td>
                      <td <?=$j['nama_hari'] == 'Kosong' ? 'class="text-danger"' : '';?>><?=$j['nama_hari'];?></td>
                      <td><?=$j['nama_mapel'];?></td>
                      <td><?=$j['nama_guru'];?></td>
                      <td>
                        <a data-id-jadwal="<?=$j['id'];?>" data-tahun-id="<?=$j['tahun_id'];?>"
                          data-jam="<?=$j['jam'];?>" data-mapel-id="<?=$j['mapel_id'];?>"
                          data-guru-id="<?=$j['guru_id'];?>" data-hari-id="<?=$j['hari_id'];?>"
                          href="javascript:void(0);" class="item_edit_jadwal badge badge-success"><i
                            class="fas fa-edit"></i>
                          Edit</a>
                        <a data-id-jadwal="<?=$j['id'];?>" href="javascript:void(0);"
                          class="item_delete_jadwal badge badge-danger"><i class="fas fa-trash"></i>
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
<?php $this->load->view('pages/_partials/modals/jadwal');?>
<?php $this->load->view('pages/_partials/footer');?>