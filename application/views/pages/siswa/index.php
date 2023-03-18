<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Siswa</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard');?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="">Siswa</a></div>
        <div class="breadcrumb-item">List</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Daftar Siswa</h4>
            </div>
            <div class="card-body">
              <a href="javascript:void(0);" class="btn btn-primary mb-3" id="newSiswaModal">Tambah Siswa</a>
              <div class="table-responsive">
                <table class="table table-striped" id="table-siswa">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Nama</th>
                      <th>Tempat Lahir</th>
                      <th>Tanggal Lahir</th>
                      <th>Jenis Kelamin</th>
                      <th>Agama</th>
                      <th>Nama Ayah</th>
                      <th>Nama Ibu</th>
                      <th>Pekerjaan Ayah</th>
                      <th>Pekerjaan Ibu</th>
                      <th>Alamat</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="show_data">
                    <?php $i = 1;?>
                    <?php foreach ($siswa as $sw): ?>
                    <tr>
                      <td><?=$i;?></td>
                      <td><?=$sw['NIS'];?></td>
                      <td><?=$sw['nama'];?></td>
                      <td><?=$sw['tempat_lahir'];?></td>
                      <td><?=$sw['tanggal_lahir'];?></td>
                      <td><?=$sw['jenis_kelamin'];?></td>
                      <td><?=$sw['agama'];?></td>
                      <td><?=$sw['nama_ayah'];?></td>
                      <td><?=$sw['nama_ibu'];?></td>
                      <td><?=$sw['pekerjaan_ayah'];?></td>
                      <td><?=$sw['pekerjaan_ibu'];?></td>
                      <td><?=$sw['alamat'];?></td>
                      <td>
                        <a data-id-siswa="<?=$sw['NIS'];?>" data-nama="<?=$sw['nama'];?>"
                          data-tempat_lahir="<?=$sw['tempat_lahir'];?>"
                          data-tanggal_lahir="<?=$sw['tanggal_lahir'];?>"
                          data-jenis-kelamin="<?=$sw['jenis_kelamin'];?>" data-agama="<?=$sw['agama'];?>"
                          data-nama_ayah="<?=$sw['nama_ayah'];?>" data-nama_ibu="<?=$sw['nama_ibu'];?>"
                          data-pekerjaan_ayah="<?=$sw['pekerjaan_ayah'];?>"
                          data-pekerjaan_ibu="<?=$sw['pekerjaan_ibu'];?>" data-alamat="<?=$sw['alamat'];?>"
                          href="javascript:void(0);" class="item_edit_siswa badge badge-success"><i
                            class="fas fa-edit"></i>
                          Edit</a>
                        <a data-id-siswa="<?=$sw['NIS'];?>" data-nama="<?=$sw['nama'];?>" href="javascript:void(0);"
                          class="item_delete_siswa badge badge-danger"><i class="fas fa-trash"></i>
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
<?php $this->load->view('pages/_partials/modals/siswa');?>
<?php $this->load->view('pages/_partials/footer');?>