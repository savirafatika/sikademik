<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Nilai Siswa</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard');?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="<?=base_url('nilai');?>">Nilai</a></div>
        <div class="breadcrumb-item"><a href="<?=$back;?>">Siswa</a></div>
        <div class="breadcrumb-item">List</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Nilai Siswa: <code><?=$nilai[0]['nama'];?></code></h4>
              <a href="<?=$back;?>" class="btn btn-round btn-secondary"><i class="fas fa-arrow-left"></i>
                Kembali</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-kelas">
                  <thead>
                    <tr>
                      <th class="align-middle">No</th>
                      <th class="align-middle">Mata Pelajaran</th>
                      <th class="align-middle text-center">Pengetahuan (KI-3)</th>
                      <th class="align-middle text-center">Keterampilan (KI-4)</th>
                      <th class="align-middle text-center">Spiritual (KI-1)</th>
                      <th class="align-middle text-center">Sosial (KI-2)</th>
                      <th class="align-middle text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="show_data">
                    <?php $i = 1;?>
                    <?php foreach ($nilai as $value): ?>
                    <tr>
                      <td><?=$i;?></td>
                      <td><?=$value['nama_mapel'];?></td>
                      <td class="text-center"><?=$value['nilai_pengetahuan'];?></td>
                      <td class="text-center"><?=$value['nilai_keterampilan'];?></td>
                      <td class="text-center"><?=$value['spiritual'] ?? '-';?></td>
                      <td class="text-center"><?=$value['sosial'] ?? '-';?></td>
                      <td class="text-center">
                        <a data-id-nilai="<?=$value['id'];?>" data-tahun-id="<?=$value['tahun_id'];?>"
                          data-mapel-id="<?=$value['mapel_id'];?>" data-siswa-id="<?=$value['siswa_id'];?>"
                          data-spiritual="<?=$value['spiritual'];?>" data-sosial="<?=$value['sosial'];?>"
                          data-nilai_pengetahuan="<?=$value['nilai_pengetahuan'];?>"
                          data-nilai_keterampilan="<?=$value['nilai_keterampilan'];?>" href=" javascript:void(0);"
                          class="item_edit_nilai badge badge-success"><i class="fas fa-edit"></i>
                          Edit</a>
                        <?php if ($user['role_id'] == 1): ?>
                        <a data-id-nilai="<?=$value['id'];?>" href="javascript:void(0);"
                          class="item_delete_nilai badge badge-danger"><i class="fas fa-trash"></i>
                          Delete</a>
                        <?php endif;?>
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
<?php $this->load->view('pages/_partials/modals/nilai');?>
<?php $this->load->view('pages/_partials/footer');?>