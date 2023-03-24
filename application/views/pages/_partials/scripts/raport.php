<script type="text/javascript">
$(document).ready(function() {
  $("#table-raport-kelas").dataTable({
    "columnDefs": [{
      "sortable": true,
      "targets": [0, 1, 2, 3]
    }]
  });

  // btn lihat kelas
  $('#btnCariRaport').on('click', function(e) {
    e.preventDefault()

    // validasi
    var kelas_id = $('[name="kelas_id"]').val();
    if (kelas_id == "" || kelas_id == null) {
      alert('Kelas harus dipilih')
      return
    }
    var tahun_id = $('[name="tahun_id"]').val();
    if (tahun_id == "" || tahun_id == null) {
      alert('Tahun harus dipilih')
      return
    }
    var semester = $('[name="semester"]').val();
    if (semester == "" || semester == null) {
      alert('Semester harus dipilih')
      return
    }

    let url = `<?=base_url('raport/daftar_siswa');?>?kelas=${kelas_id}&tahun=${tahun_id}&semester=${semester}`;
    window.location.replace(url);
  })

  // btn lihat raport raport siswa
  $('#show_data').on('click', '.item_lihat_raport_siswa', function(e) {
    e.preventDefault()
    var nis = $(this).data('nis-siswa');
    let searchParams = new URLSearchParams(window.location.search)
    let kelas = searchParams.get('kelas')
    let tahun = searchParams.get('tahun')
    let semester = searchParams.get('semester')
    let url =
      `<?=base_url('raport/lihat_raport/');?>${nis}?kelas=${kelas}&tahun=${tahun}&semester=${semester}`;
    window.location.replace(url);
  })

  // get mapel by kelas id
  $('#kelas_id').change(function() {
    var id = $(this).val();
    // get mapel
    $.ajax({
      url: "<?=base_url('nilai/get_mapel');?>",
      method: "POST",
      data: {
        id: id
      },
      async: true,
      dataType: 'json',
      success: function(data) {
        var html = '<option value="" disabled selected>Pilih Mata Pelajaran</option>';
        var i;
        for (i = 0; i < data.length; i++) {
          html += '<option value=' + data[i].id + '>' + data[i].nama_mapel +
            '</option>';
        }
        $('#mapel_id').html(html);
      }
    });

    // get siswa
    $.ajax({
      url: "<?=base_url('nilai/get_siswa');?>",
      method: "POST",
      data: {
        id: id
      },
      async: true,
      dataType: 'json',
      success: function(data) {
        var html = '<option value="" disabled selected>Pilih Siswa</option>';
        var i;
        for (i = 0; i < data.length; i++) {
          html += '<option value=' + data[i].NIS + '>' + data[i].nama +
            '</option>';
        }
        $('#siswa_id').html(html);
      }
    });
    return false;
  });

  // btn add modal
  $("#newJadwalModal").click(function(e) {
    e.preventDefault()
    $('[name="tahun_id"]').val("");
    $('[name="mapel_id"]').val("");
    $('[name="guru_id"]').val("");
    $('[name="hari_id"]').val("");
    $('[name="jam"]').val("");
    $('#raportModal').modal('show');
  });

  // btn edit modal
  $('#show_data').on('click', '.item_edit_raport', function(e) {
    e.preventDefault()
    var id = $(this).data('id-raport');
    $('#isEdit').prepend(`<input type="hidden" name="id_raport" value="${id}" />`);

    var tahun_id = $(this).data('tahun-id');
    $("#tahun_id option:selected").prop("selected", false);
    $(`#tahun_id option[value='${tahun_id}']`).prop('selected', true);

    var mapel_id = $(this).data('mapel-id');
    $("#mapel_id option:selected").prop("selected", false);
    $(`#mapel_id option[value='${mapel_id}']`).prop('selected', true);

    var guru_id = $(this).data('guru-id');
    $("#guru_id option:selected").prop("selected", false);
    $(`#guru_id option[value='${guru_id}']`).prop('selected', true);

    var hari_id = $(this).data('hari-id');
    $("#hari_id option:selected").prop("selected", false);
    $(`#hari_id option[value='${hari_id}']`).prop('selected', true);

    var jam = $(this).data('jam');
    $('[name="jam"]').val(jam);

    $('#raportModal').modal('show');
  })

  // btn delete modal
  $('#show_data').on('click', '.item_delete_raport', function() {
    var id = $(this).data('id-raport');

    $('[name="id_raport_delete"]').val(id);
    $('#modalHapusJadwal').modal('show');
  });

  //btn simpan raport
  $('#btnSimpanJadwal').on('click', function(e) {
    e.preventDefault();
    var id = "<?=$this->uri->segment(3);?>"
    var isEdit = $('input[name="id_raport"]').val();
    var tahun_id = $('#tahun_id').find(":selected").val();
    var mapel_id = $('#mapel_id').find(":selected").val();
    var guru_id = $('#guru_id').find(":selected").val();
    var hari_id = $('#hari_id').find(":selected").val();
    var jam = $('input[name="jam"]').val();

    var action = "<?=base_url('raport/store/');?>"
    var message = 'ditambahkan!';
    if (isEdit) {
      action = '<?=base_url('raport/update');?>';
      message = 'diubah!';
    }

    $.ajax({
      type: "POST",
      url: action,
      dataType: "JSON",
      data: {
        kelas_id: id,
        id_raport: isEdit,
        jam: jam,
        tahun_id: tahun_id,
        mapel_id: mapel_id,
        guru_id: guru_id,
        hari_id: hari_id
      },
      success: function(data) {
        $('[name="jam"]').val("");
        $('#tahun_id').prop('selectedIndex', 0);
        $('#mapel_id').prop('selectedIndex', 0);
        $('#guru_id').prop('selectedIndex', 0);
        $('#hari_id').prop('selectedIndex', 0);
        $('#modalGuru').modal('hide');
        swal('Berhasil', `Jadwal berhasil ${message}`, 'success');
        window.location.reload()
      }
    });
    return false;
  });

  //delete record in database
  $('#btn_delete_raport').on('click', function() {
    var id = $('[name="id_raport_delete"]').val();
    $.ajax({
      type: "POST",
      url: "<?=base_url('raport/delete');?>",
      dataType: "JSON",
      data: {
        id: id
      },
      success: function(data) {
        $('[name="id_raport_delete"]').val("");
        $('#modalHapusJadwal').modal('hide');
        swal('Berhasil', 'Jadwal berhasil dihapus!', 'success');
        window.location.reload()
      }
    });
    return false;
  });
})
</script>