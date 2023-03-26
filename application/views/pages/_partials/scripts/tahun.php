<script type="text/javascript">
$(document).ready(function() {
  $("#table-tahun").dataTable({
    "columnDefs": [{
      "sortable": true,
      "targets": [0, 1]
    }]
  });

  // show_tahun(); //call function show all product

  //function show all product
  function show_tahun() {
    $.ajax({
      type: 'ajax',
      url: '<?=base_url('tahun/getTahun');?>',
      async: true,
      dataType: 'json',
      success: function(data) {
        var html = '';
        var i;
        var no = 1;
        for (i = 0; i < data.length; i++) {
          html += '<tr>' +
            '<td>' + no++ + '</td>' +
            '<td>' + data[i].tahun + '</td>' +
            '<td>' +
            '<a href="javascript:void(0);" class="badge badge-success item_edit_tahun" data-id-tahun="' +
            data[
              i].id + '" data-tahun="' + data[i].tahun + '"><i class="fas fa-edit"></i> Edit</a>' +
            ' ' +
            '<a href="javascript:void(0);" class="badge badge-danger item_delete_tahun" data-tahun="' +
            data[
              i].tahun + '" data-id-tahun="' +
            data[i].id + '"><i class="fas fa-trash"></i> Delete</a>' +
            '</td>' +
            '</tr>';
        }
        $('#show_data').html(html);
      }

    });
  }

  //btn simpan tahun
  $('#btnSimpanTahun').on('click', function(e) {
    e.preventDefault();
    var isEdit = $('input[name="id_tahun"]').val();
    var tahun = $('input[name="tahun"]').val();

    var action = '<?=base_url('tahun/store');?>';
    var message = 'ditambahkan!';
    if (isEdit) {
      action = '<?=base_url('tahun/update');?>';
      message = 'diubah!';
    }

    $.ajax({
      type: "POST",
      url: action,
      dataType: "JSON",
      data: {
        id: isEdit,
        tahun: tahun
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {
          $('[name="tahun"]').val("");
          $('#modalTahun').modal('hide');
          swal('Berhasil', `Tahun berhasil ${message}`, 'success');
          show_tahun();
        } else {
          alert(data.error);
        }
      }
    });
    return false;
  });

  //delete record to database
  $('#btn_delete_tahun').on('click', function() {
    var id = $('[name="id_tahun_delete"]').val();
    $.ajax({
      type: "POST",
      url: "<?=base_url('tahun/delete');?>",
      dataType: "JSON",
      data: {
        id: id
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {
          $('[name="id_tahun_delete"]').val("");
          $('#modalHapusTahun').modal('hide');
          swal('Berhasil', 'Tahun berhasil dihapus!', 'success');
          show_tahun();
        } else {
          alert(data.error);
        }
      }
    });
    return false;
  });

  // btn add modal
  $("#newTahunModal").click(function(e) {
    e.preventDefault()
    $('[name="id_tahun"]').remove();
    $('[name="tahun"]').val("");
    $('#modalTahun').modal('show');
  })
  // btn edit modal
  $('#show_data').on('click', '.item_edit_tahun', function(e) {
    e.preventDefault()
    var id = $(this).data('id-tahun');
    $('#isEdit').prepend(`<input type="hidden" name="id_tahun" value="${id}" />`);
    var tahun = $(this).data('tahun');
    $('[name="tahun"]').val(tahun);
    $('#modalTahun').modal('show');
  })

  // btn delete modal
  $('#show_data').on('click', '.item_delete_tahun', function() {
    var id = $(this).data('id-tahun');
    var tahun = $(this).data('tahun');

    $('#modalHapusTahun').modal('show');
    $('#tahun_del').text(tahun);
    $('[name="id_tahun_delete"]').val(id);
  });
})
</script>