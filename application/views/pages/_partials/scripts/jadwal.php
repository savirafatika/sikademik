<script type="text/javascript">
$(document).ready(function() {
  $("#table-jadwal-kelas").dataTable({
    "columnDefs": [{
      "sortable": true,
      "targets": [0, 1, 2, 3]
    }]
  });

  // btn lihat kelas
  $('#show_data').on('click', '.item_lihat_jadwal', function(e) {
    e.preventDefault()
    var id = $(this).data('id-kelas');
    let url = `<?=base_url('jadwal/jadwal_kelas/');?>${id}`;
    window.location.replace(url);
  })

  // btn lihat jadwal guru
  $('#show_data').on('click', '.item_lihat_jadwal_guru', function(e) {
    e.preventDefault()
    var nip = $(this).data('nip-guru');
    let url = `<?=base_url('jadwal_guru/nip/');?>${nip}`;
    window.location.replace(url);
  })

  // btn lihat jadwal guru
  $('#show_data').on('click', '.item_lihat_jadwal_guru_kelas', function(e) {
    e.preventDefault()
    var id = $(this).data('id-kelas');
    var nip = $(this).data('nip-guru');
    let url = `<?=base_url('jadwal_guru/kelas/');?>${id}?nip=${nip}`;
    window.location.replace(url);
  })

  // btn add modal
  $("#newJadwalModal").click(function(e) {
    e.preventDefault()
    $('[name="tahun_id"]').val("");
    $('[name="mapel_id"]').val("");
    $('[name="guru_id"]').val("");
    $('[name="hari_id"]').val("");
    $('[name="jam"]').val("");
    $('#jadwalModal').modal('show');
  });

  // btn edit modal
  $('#show_data').on('click', '.item_edit_jadwal', function(e) {
    e.preventDefault()
    var id = $(this).data('id-jadwal');
    $('#isEdit').prepend(`<input type="hidden" name="id_jadwal" value="${id}" />`);

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

    $('#jadwalModal').modal('show');
  })

  // btn delete modal
  $('#show_data').on('click', '.item_delete_jadwal', function() {
    var id = $(this).data('id-jadwal');

    $('[name="id_jadwal_delete"]').val(id);
    $('#modalHapusJadwal').modal('show');
  });

  //btn simpan jadwal
  $('#btnSimpanJadwal').on('click', function(e) {
    e.preventDefault();
    var id = "<?=$this->uri->segment(3);?>"
    var isEdit = $('input[name="id_jadwal"]').val();
    var tahun_id = $('#tahun_id').find(":selected").val();
    var mapel_id = $('#mapel_id').find(":selected").val();
    var guru_id = $('#guru_id').find(":selected").val();
    var hari_id = $('#hari_id').find(":selected").val();
    var jam = $('input[name="jam"]').val();

    var action = "<?=base_url('jadwal/store/');?>"
    var message = 'ditambahkan!';
    if (isEdit) {
      action = '<?=base_url('jadwal/update');?>';
      message = 'diubah!';
    }

    $.ajax({
      type: "POST",
      url: action,
      dataType: "JSON",
      data: {
        kelas_id: id,
        id_jadwal: isEdit,
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
  $('#btn_delete_jadwal').on('click', function() {
    var id = $('[name="id_jadwal_delete"]').val();
    $.ajax({
      type: "POST",
      url: "<?=base_url('jadwal/delete');?>",
      dataType: "JSON",
      data: {
        id: id
      },
      success: function(data) {
        $('[name="id_jadwal_delete"]').val("");
        $('#modalHapusJadwal').modal('hide');
        swal('Berhasil', 'Jadwal berhasil dihapus!', 'success');
        window.location.reload()
      }
    });
    return false;
  });
})
</script>