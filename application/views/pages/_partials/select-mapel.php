<div class="form-group">
<div class="section-title mb-1">Mata Pelajaran Hari <b><?=$hari;?></b></div>
  <select name="<?=strtolower($hari);?>" id="<?=strtolower($hari);?>" class="form-control">
    <option value="" disabled selected>Pilih Mata Pelajaran</option>
    <?php foreach ($mapel as $t): ?>
    <option value="<?=$t['id'];?>"><?=$t['nama_mapel'];?></option>
    <?php endforeach;?>
  </select>
</div>