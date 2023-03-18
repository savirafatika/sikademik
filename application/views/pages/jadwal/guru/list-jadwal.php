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
        <div class="breadcrumb-item"><a href="<?=base_url('jadwal_guru');?>">Jadwal Guru</a></div>
        <div class="breadcrumb-item">List Jadwal</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Jadwal Pelajaran <code>Kelas: <?=$kelas['nama_kelas'];?></code> </h4>
              <a href="<?=base_url('jadwal_guru/nip/' . $this->input->get('nip'));?>"
                class="btn btn-round btn-secondary"><i class="fas fa-arrow-left"></i>
                Kembali</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-kelas">
                  <thead>
                    <tr>
                      <th class="align-middle text-center">Waktu</th>
                      <th class="align-middle text-center">Hari</th>
                      <th class="align-middle text-center">Mata Pelajaran</th>
                      <th class="align-middle text-center">Tahun Ajaran</th>
                    </tr>
                  </thead>
                  <tbody id="show_data">
                    <?php $i = 1;?>
                    <?php foreach ($jadwal as $j): ?>
                    <tr class="text-center">
                      <td><?=$j['jam'];?></td>
                      <td <?=$j['nama_hari'] == 'Kosong' ? 'class="text-danger"' : '';?>><?=$j['nama_hari'];?></td>
                      <td><?=$j['nama_mapel'];?></td>
                      <td><?=$j['tahun_ajaran'];?></td>
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
<?php $this->load->view('pages/_partials/footer');?>