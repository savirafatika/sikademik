<script type="text/javascript">
$(document).ready(function() {
  $("#table-kelas").dataTable({
    "columnDefs": [{
      "sortable": true,
      "targets": [0, 1]
    }]
  });

  // show_kelas(); //call function show all product

  //function show all product
  function show_kelas() {
    $.ajax({
      type: 'ajax',
      url: '<?=base_url('kelas/getKelas');?>',
      async: true,
      dataType: 'json',
      success: function(data) {
        var html = '';
        var i;
        var no = 1;
        for (i = 0; i < data.length; i++) {
          html += '<tr>' +
            '<td>' + no++ + '</td>' +
            '<td>' + data[i].nama_kelas + '</td>' +
            '<td>' +
            '<a href="javascript:void(0);" class="badge badge-success item_edit_kelas" data-id-kelas="' +
            data[
              i].id + '" data-nama-kelas="' + data[i].nama_kelas + '"><i class="fas fa-edit"></i> Edit</a>' +
            ' ' +
            '<a href="javascript:void(0);" class="badge badge-danger item_delete_kelas" data-nama-kelas="' +
            data[
              i].nama_kelas + '" data-id-kelas="' +
            data[i].id + '"><i class="fas fa-trash"></i> Delete</a>' +
            '</td>' +
            '</tr>';
        }
        $('#show_data').html(html);
      }

    });
  }

  //btn simpan kelas
  $('#btnSimpanKelas').on('click', function(e) {
    e.preventDefault();
    var isEdit = $('input[name="id_kelas"]').val();
    var nama_kelas = $('input[name="nama_kelas"]').val();

    var action = '<?=base_url('kelas/store');?>';
    var message = 'ditambahkan!';
    if (isEdit) {
      action = '<?=base_url('kelas/update');?>';
      message = 'diubah!';
    }

    $.ajax({
      type: "POST",
      url: action,
      dataType: "JSON",
      data: {
        id: isEdit,
        nama_kelas: nama_kelas,
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {
          $('[name="nama_kelas"]').val("");
          $('#modalKelas').modal('hide');
          swal('Berhasil', `Kelas berhasil ${message}`, 'success');
          show_kelas();
        } else {
          alert(data.error);
        }
      }
    });
    return false;
  });

  //delete record to database
  $('#btn_delete_kelas').on('click', function() {
    var id = $('[name="id_kelas_delete"]').val();
    $.ajax({
      type: "POST",
      url: "<?=base_url('kelas/delete');?>",
      dataType: "JSON",
      data: {
        id: id
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {
          $('[name="id_kelas_delete"]').val("");
          $('#modalHapusKelas').modal('hide');
          swal('Berhasil', 'Kelas berhasil dihapus!', 'success');
          show_kelas();
        } else {
          alert(data.error);
        }
      }
    });
    return false;
  });

  // btn add modal
  $("#newKelasModal").click(function(e) {
    e.preventDefault()
    $('[name="id_kelas"]').remove();
    $('[name="nama_kelas"]').val("");
    $('#modalKelas').modal('show');
  })
  // btn edit modal
  $('#show_data').on('click', '.item_edit_kelas', function(e) {
    e.preventDefault()
    var id = $(this).data('id-kelas');
    $('#isEdit').prepend(`<input type="hidden" name="id_kelas" value="${id}" />`);
    var nama_kelas = $(this).data('nama-kelas');
    $('[name="nama_kelas"]').val(nama_kelas);
    $('#modalKelas').modal('show');
  })

  // btn delete modal
  $('#show_data').on('click', '.item_delete_kelas', function() {
    var id = $(this).data('id-kelas');
    var nama_kelas = $(this).data('nama-kelas');

    $('#modalHapusKelas').modal('show');
    $('#nama_kelas_del').text(nama_kelas);
    $('[name="id_kelas_delete"]').val(id);
  });
})
</script>