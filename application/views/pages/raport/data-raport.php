<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('pages/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Raport Siswa</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard');?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="">Raport Siswa</a></div>
        <div class="breadcrumb-item">List</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Capaian Kompetensi</h4>
              <a href="<?=$back;?>" class="btn btn-round btn-secondary"><i class="fas fa-arrow-left"></i>
                Kembali</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="table-kelas">
                  <thead>
                    <tr>
                      <th class="align-middle text-center" rowspan="2">No</th>
                      <th class=" align-middle text-left" rowspan="2">Mata Pelajaran</th>
                      <th class="align-middle text-center" colspan="2">Pengetahuan (KI-3)</th>
                      <th class="align-middle text-center" colspan="2">Keterampilan (KI-4)</th>
                      <th class="align-middle text-center" colspan="2">Sikap Spiritual Dan Sosial (KI-1 dan
                        KI-2)</th>
                    </tr>
                    <tr class="text-center">
                      <th>Nilai</th>
                      <th>Huruf</th>
                      <th>Nilai</th>
                      <th>Huruf</th>
                      <th>Spiritual</th>
                      <th>Sosial</th>
                    </tr>
                  </thead>
                  <tbody id="show_data">
                    <tr>
                      <td colspan="8"><b>Kelompok A ( Mata Pelajaran Wajib )</b></td>
                    </tr>
                    <?php $jumlah_nilai_pengetahuan  = 0;?>
                    <?php $jumlah_nilai_keterampilan = 0;?>
                    <?php $no_a                      = 1;?>
                    <?php foreach ($grup_a as $item): ?>
                    <tr class="text-center">
                      <td><?=$no_a;?></td>
                      <td class="text-left"><?=$item['nama_mapel'];?></td>
                      <td><?=$item['nilai_pengetahuan'];?></td>
                      <td><?=conversi_nilai($item['nilai_pengetahuan']);?></td>
                      <td><?=$item['nilai_keterampilan'];?></td>
                      <td><?=conversi_nilai($item['nilai_keterampilan']);?></td>
                      <td><?=$item['spiritual'] ?? '-';?></td>
                      <td><?=$item['sosial'] ?? '-';?></td>
                    </tr>
                    <?php $jumlah_nilai_pengetahuan += $item['nilai_pengetahuan'];?>
                    <?php $jumlah_nilai_keterampilan += $item['nilai_keterampilan'];?>
                    <?php $no_a++;?>
                    <?php endforeach;?>
                    <tr>
                      <td colspan="8"><b>Kelompok B ( Mulok )</b></td>
                    </tr>
                    <?php $no_b = $no_a;?>
                    <?php foreach ($grup_b as $item): ?>
                    <tr class="text-center">
                      <td><?=$no_b;?></td>
                      <td class="text-left"><?=$item['nama_mapel'];?></td>
                      <td><?=$item['nilai_pengetahuan'];?></td>
                      <td><?=conversi_nilai($item['nilai_pengetahuan']);?></td>
                      <td><?=$item['nilai_keterampilan'];?></td>
                      <td><?=conversi_nilai($item['nilai_keterampilan']);?></td>
                      <td><?=$item['spiritual'] ?? '-';?></td>
                      <td><?=$item['sosial'] ?? '-';?></td>
                    </tr>
                    <?php $jumlah_nilai_pengetahuan += $item['nilai_pengetahuan'];?>
                    <?php $jumlah_nilai_keterampilan += $item['nilai_keterampilan'];?>
                    <?php $no_b++;?>
                    <?php endforeach;?>
                    <tr>
                      <td colspan="2"><b>Jumlah Nilai</b></td>
                      <td colspan="6"><b><?=$jumlah_nilai_pengetahuan + $jumlah_nilai_keterampilan;?></b></td>
                    </tr>
                    <tr>
                      <td colspan="2"><b>Ranking</b></td>
                      <td colspan="6"><?=get_ranking($param['kelas'], $param['siswa']);?> Dari : <?=$jumlah_siswa;?>
                        Siswa</td>
                    </tr>
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