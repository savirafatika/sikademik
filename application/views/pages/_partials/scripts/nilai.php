<script type="text/javascript">
$(document).ready(function() {
  $("#table-nilai-kelas").dataTable({
    "columnDefs": [{
      "sortable": true,
      "targets": [0, 1, 2, 3]
    }]
  });

  // btn lihat kelas
  $('#btnCariNilai').on('click', function(e) {
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

    let url = `<?=base_url('nilai/daftar_siswa');?>?kelas=${kelas_id}&tahun=${tahun_id}&semester=${semester}`;
    window.location.replace(url);
  })

  // btn lihat nilai nilai siswa
  $('#show_data').on('click', '.item_lihat_nilai_siswa', function(e) {
    e.preventDefault()
    var nis = $(this).data('nis-siswa');
    let searchParams = new URLSearchParams(window.location.search)
    let kelas = searchParams.get('kelas')
    let tahun = searchParams.get('tahun')
    let semester = searchParams.get('semester')
    let url =
      `<?=base_url('nilai/lihat_nilai/');?>${nis}?kelas=${kelas}&tahun=${tahun}&semester=${semester}`;
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

  // btn edit modal
  $('#show_data').on('click', '.item_edit_nilai', function(e) {
    e.preventDefault()
    var id = $(this).data('id-nilai');
    $('#isEdit').prepend(`<input type="hidden" name="id_nilai" value="${id}" />`);

    var tahun_id = $(this).data('tahun-id');
    $("#tahun_id option:selected").prop("selected", false);
    $(`#tahun_id option[value='${tahun_id}']`).prop('selected', true);

    var mapel_id = $(this).data('mapel-id');
    $("#mapel_id option:selected").prop("selected", false);
    $(`#mapel_id option[value='${mapel_id}']`).prop('selected', true);

    var kelas_id = $(this).data('mapel-id');
    $("#kelas_id option:selected").prop("selected", false);
    $(`#kelas_id option[value='${kelas_id}']`).prop('selected', true);

    var siswa_id = $(this).data('siswa-id');
    $("#siswa_id option:selected").prop("selected", false);
    $(`#siswa_id option[value='${siswa_id}']`).prop('selected', true);

    var semester = $(this).data('semester');
    $("#semester option:selected").prop("selected", false);
    $(`#semester option[value='${semester}']`).prop('selected', true);

    var nilai_pengetahuan = $(this).data('nilai_pengetahuan');
    $('[name="nilai_pengetahuan"]').val(nilai_pengetahuan);

    var nilai_keterampilan = $(this).data('nilai_keterampilan');
    $('[name="nilai_keterampilan"]').val(nilai_keterampilan);

    var spiritual = $(this).data('spiritual');
    $("#spiritual option:selected").prop("selected", false);
    $(`#spiritual option[value='${spiritual}']`).prop('selected', true);

    var sosial = $(this).data('sosial');
    $("#sosial option:selected").prop("selected", false);
    $(`#sosial option[value='${sosial}']`).prop('selected', true);

    $('#nilaiModal').modal('show');
  })

  // btn delete modal
  $('#show_data').on('click', '.item_delete_nilai', function() {
    var id = $(this).data('id-nilai');

    $('[name="id_nilai_delete"]').val(id);
    $('#modalHapusNilai').modal('show');
  });

  //btn simpan nilai
  $('#btnSimpanNilai').on('click', function(e) {
    e.preventDefault();
    var isEdit = $('input[name="id_nilai"]').val();
    var spiritual = $('#spiritual').find(":selected").val();
    var sosial = $('#sosial').find(":selected").val();
    var nilai_pengetahuan = $('input[name="nilai_pengetahuan"]').val();
    var nilai_keterampilan = $('input[name="nilai_keterampilan"]').val();

    var action = "<?=base_url('nilai/input/');?>"
    var message = 'ditambahkan!';
    if (isEdit) {
      action = '<?=base_url('nilai/update');?>';
      message = 'diubah!';
    }

    $.ajax({
      type: "POST",
      url: action,
      dataType: "JSON",
      data: {
        id_nilai: isEdit,
        nilai_pengetahuan: nilai_pengetahuan,
        nilai_keterampilan: nilai_keterampilan,
        spiritual: spiritual,
        sosial: sosial
      },
      success: function(data) {
        $('#spiritual').prop('selectedIndex', 0);
        $('#sosial').prop('selectedIndex', 0);
        $('[name="nilai_pengetahuan"]').val("");
        $('[name="nilai_keterampilan"]').val("");
        $('#nilaiModal').modal('hide');
        swal('Berhasil', `Nilai berhasil ${message}`, 'success');
        window.location.reload()
      }
    });
    return false;
  });

  //delete record in database
  $('#btn_delete_nilai').on('click', function() {
    var id = $('[name="id_nilai_delete"]').val();
    $.ajax({
      type: "POST",
      url: "<?=base_url('nilai/delete');?>",
      dataType: "JSON",
      data: {
        id: id
      },
      success: function(data) {
        $('[name="id_nilai_delete"]').val("");
        $('#modalHapusNilai').modal('hide');
        swal('Berhasil', 'Nilai berhasil dihapus!', 'success');
        window.location.reload()
      }
    });
    return false;
  });
})
</script>