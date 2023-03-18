<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Guru</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard');?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="">Guru</a></div>
        <div class="breadcrumb-item">List</div>
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
              <a href="javascript:void(0);" class="btn btn-primary mb-3" id="newGuruModal">Tambah Guru</a>
              <div class="table-responsive">
                <table class="table table-striped" id="table-guru">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIP</th>
                      <th>Nama</th>
                      <th>Tempat Lahir</th>
                      <th>Tanggal Lahir</th>
                      <th>Jenis Kelamin</th>
                      <th>Agama</th>
                      <th>Status Kawin</th>
                      <th>Alamat</th>
                      <th>Perguruan Tinggi</th>
                      <th>Jurusan</th>
                      <th>Tahun Lulus</th>
                      <th>Golongan</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="show_data">
                    <?php $i = 1;?>
                    <?php foreach ($guru as $gr): ?>
                    <tr>
                      <td><?=$i;?></td>
                      <td><?=$gr['NIP'];?></td>
                      <td><?=$gr['nama'];?></td>
                      <td><?=$gr['tempat_lahir'];?></td>
                      <td><?=$gr['tanggal_lahir'];?></td>
                      <td><?=$gr['jenis_kelamin'];?></td>
                      <td><?=$gr['agama'];?></td>
                      <td><?=$gr['status_perkawinan'];?></td>
                      <td><?=$gr['nama_perguruan_tinggi'];?></td>
                      <td><?=$gr['jurusan'];?></td>
                      <td><?=$gr['tahun_lulus'];?></td>
                      <td><?=$gr['golongan'];?></td>
                      <td><?=$gr['keterangan'];?></td>
                      <td><?=$gr['alamat'];?></td>
                      <td>
                        <a data-id-guru="<?=$gr['NIP'];?>" data-nama="<?=$gr['nama'];?>"
                          data-tempat_lahir="<?=$gr['tempat_lahir'];?>"
                          data-tanggal_lahir="<?=$gr['tanggal_lahir'];?>"
                          data-jenis-kelamin="<?=$gr['jenis_kelamin'];?>" data-agama="<?=$gr['agama'];?>"
                          data-status_perkawinan="<?=$gr['status_perkawinan'];?>"
                          data-nama_perguruan_tinggi="<?=$gr['nama_perguruan_tinggi'];?>"
                          data-jurusan="<?=$gr['jurusan'];?>" data-tahun_lulus="<?=$gr['tahun_lulus'];?>"
                          data-alamat="<?=$gr['alamat'];?>" data-keterangan="<?=$gr['keterangan'];?>"
                          href="javascript:void(0);" class="item_edit_guru badge badge-success"><i
                            class="fas fa-edit"></i>
                          Edit</a>
                        <a data-id-guru="<?=$gr['NIP'];?>" data-nama="<?=$gr['nama'];?>" href="javascript:void(0);"
                          class="item_delete_guru badge badge-danger"><i class="fas fa-trash"></i>
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
<?php $this->load->view('pages/_partials/modals/guru');?>
<?php $this->load->view('pages/_partials/footer');?>