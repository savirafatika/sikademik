<script type="text/javascript">
$(document).ready(function() {
  $("#table-user").dataTable({
    "columnDefs": [{
      "sortable": true,
      "targets": [0, 1, 2, 3, 4]
    }]
  });

  // show_user(); //call function show all product

  //function show all product
  function show_user() {
    $.ajax({
      type: 'ajax',
      url: '<?=base_url('user/getUser');?>',
      async: true,
      dataType: 'json',
      success: function(data) {
        var html = '';
        var i;
        var no = 1;
        for (i = 0; i < data.length; i++) {
          let status = '-';
          if (data[i].is_active == 1) {
            status = 'Aktif';
          } else {
            status = 'Tidak Aktif';
          }
          html += '<tr>' +
            '<td>' + no++ + '</td>' +
            '<td>' + data[i].name + '</td>' +
            '<td>' + data[i].email + '</td>' +
            '<td>' + data[i].role + '</td>' +
            '<td>' + status + '</td>' +
            '<td>' +
            '<a href="javascript:void(0);" class="badge badge-success item_edit_user" data-id-user="' + data[
              i].id + '" data-nama="' + data[i].name + '"  data-email="' + data[
              i].email + '" data-role-id="' + data[
              i].role_id + '" data-status="' + data[i].is_active + '"><i class="fas fa-edit"></i> Edit</a>' +
            ' ' +
            '<a href="javascript:void(0);" class="badge badge-danger item_delete_user" data-nama="' + data[
              i].name + '" data-id-user="' +
            data[i].id + '"><i class="fas fa-trash"></i> Delete</a>' +
            '</td>' +
            '</tr>';
        }
        $('#show_data').html(html);
      }

    });
  }

  //Save sub user
  $('#btnSimpanUser').on('click', function(e) {
    e.preventDefault();
    var isEdit = $('input[name="id_user"]').val();
    var nama = $('input[name="nama"]').val();
    var email = $('input[name="email"]').val();
    var role_id = $('#role_id').find(":selected").val();
    var is_active = $('#is_active').is(":checked");

    var action = '<?=base_url('user/store');?>';
    var message = 'ditambahkan!';
    if (isEdit) {
      action = '<?=base_url('user/update');?>';
      message = 'diubah!';
    }

    $.ajax({
      type: "POST",
      url: action,
      dataType: "JSON",
      data: {
        id: isEdit,
        role_id: role_id,
        nama: nama,
        email: email,
        is_active: is_active ? 1 : 0
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {
          var nama = $('input[name="nama"]').val("");
          var email = $('input[name="email"]').val("");
          var icon = $('input[name="icon"]').val("");
          var role_id = $('#role_id').prop('selectedIndex', 0);
          var is_active = $('#is_active').removeAttr('checked');
          $('#modalUser').modal('hide');
          swal('Berhasil', `User berhasil ${message}`, 'success');
          show_user();
        } else {
          alert(data.error);
        }
      }
    });
    return false;
  });

  //delete record to database
  $('#btn_delete_user').on('click', function() {
    var id = $('[name="id_user_delete"]').val();
    $.ajax({
      type: "POST",
      url: "<?=base_url('user/delete');?>",
      dataType: "JSON",
      data: {
        id_user: id
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {
          $('[name="id_user_delete"]').val("");
          $('#modalHapusUser').modal('hide');
          swal('Berhasil', 'User berhasil dihapus!', 'success');
          show_user();
        } else {
          alert(data.error);
        }
      }
    });
    return false;
  });

  // add modal
  $("#newUserModal").click(function(e) {
    e.preventDefault()
    $('[name="id_user"]').remove();
    $('[name="nama"]').val("");
    $('[name="email"]').val("");
    $("#role_id").val("");
    $("#is_active").prop('checked', true);
    $('#modalUser').modal('show');
  })
  // edit modal
  $('#show_data').on('click', '.item_edit_user', function(e) {
    e.preventDefault()
    var id = $(this).data('id-user');
    $('#isEdit').prepend(`<input type="hidden" name="id_user" value="${id}" />`);
    var nama = $(this).data('nama');
    var email = $(this).data('email');
    var role_id = $(this).data('role-id');
    var status = $(this).data('status');
    $('#modalUser').modal('show');
    $('[name="nama"]').val(nama);
    $('[name="email"]').val(email);
    $("#role_id option:selected").prop("selected", false);
    $(`#role_id option[value='${role_id}']`).prop('selected', true);

    if (status == 1) {
      $("#is_active").prop('checked', true);
    } else {
      $("#is_active").prop('checked', false);
    }
  })

  // delete modal
  $('#show_data').on('click', '.item_delete_user', function() {
    var id = $(this).data('id-user');
    var name = $(this).data('nama');

    $('#modalHapusUser').modal('show');
    $('#nama_user').text(name);
    $('[name="id_user_delete"]').val(id);
  });
})
</script>