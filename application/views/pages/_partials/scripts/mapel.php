<script type="text/javascript">
$(document).ready(function() {
  $("#table-mapel").dataTable({
    "columnDefs": [{
      "sortable": true,
      "targets": [0, 1, 2]
    }]
  });

  // btn lihat kelas
  $('#show_data').on('click', '.item_lihat_mapel', function(e) {
    e.preventDefault()
    var id = $(this).data('id-kelas');
    let url = `<?=base_url('mapel/kelas/');?>${id}`;
    window.location.replace(url);
  })


  //btn simpan mapel
  $('#btnSimpanMapel').on('click', function(e) {
    e.preventDefault();
    var isEdit = $('input[name="id_mapel"]').val();
    var nama_mapel = $('input[name="nama_mapel"]').val();
    var grup = $("input[name='grup']:checked").val();
    var kelas_id = '<?=$this->uri->segment(3);?>';

    var action = "<?=base_url('mapel/store');?>"
    var message = 'ditambahkan!';
    if (isEdit) {
      action = '<?=base_url('mapel/update');?>';
      message = 'diubah!';
    }

    $.ajax({
      type: "POST",
      url: action,
      dataType: "JSON",
      data: {
        id: isEdit,
        nama_mapel: nama_mapel,
        grup: grup,
        kelas_id: kelas_id,
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {
          $('[name="nama_mapel"]').val("");
          $('[name="grup"]').attr("checked", false);
          $('#modalMapel').modal('hide');
          swal('Berhasil', `Mata Pelajaran berhasil ${message}`, 'success');
          window.location.reload()
        } else {
          alert(data.error);
        }
      }
    });
    return false;
  });

  //delete record to database
  $('#btn_delete_mapel').on('click', function() {
    var id = $('[name="id_mapel_delete"]').val();
    $.ajax({
      type: "POST",
      url: "<?=base_url('mapel/delete');?>",
      dataType: "JSON",
      data: {
        id: id
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {
          $('[name="id_mapel_delete"]').val("");
          $('#modalHapusMapel').modal('hide');
          swal('Berhasil', 'Mata Pelajaran berhasil dihapus!', 'success');
          window.location.reload()
        } else {
          alert(data.error);
        }
      }
    });
    return false;
  });

  // btn add modal
  $("#newMapelModal").click(function(e) {
    e.preventDefault()
    $('[name="id_mapel"]').remove();
    $('[name="nama_mapel"]').val("");
    $('[name="grup"]').attr("checked", false);
    $('#modalMapel').modal('show');
  })
  // btn edit modal
  $('#show_data').on('click', '.item_edit_mapel', function(e) {
    e.preventDefault()
    var id = $(this).data('id-mapel');
    $('#isEdit').prepend(`<input type="hidden" name="id_mapel" value="${id}" />`);
    var nama_mapel = $(this).data('nama-mapel');
    $('[name="nama_mapel"]').val(nama_mapel);
    var grup = $(this).data('grup');

    $('[name="grup"]').attr("checked", false);
    $(`input:radio[name="grup"][value="${grup}"]`).attr('checked', true);

    $('#modalMapel').modal('show');
  })

  // btn delete modal
  $('#show_data').on('click', '.item_delete_mapel', function() {
    var id = $(this).data('id-mapel');
    var nama_mapel = $(this).data('nama-mapel');

    $('#modalHapusMapel').modal('show');
    $('#nama_mapel_del').text(nama_mapel);
    $('[name="id_mapel_delete"]').val(id);
  });
})
</script>