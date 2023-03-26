<script type="text/javascript">
$(document).ready(function() {
  $("#table-role").dataTable({
    "columnDefs": [{
      "sortable": true,
      "targets": [0, 1]
    }]
  });

  // Modal tambah Role
  $("#newRoleModal").fireModal({
    title: 'Tambah Role',
    body: $("#modal-role"),
    footerClass: 'bg-whitesmoke',
    autoFocus: false,
    onFormSubmit: function(modal, e, form) {
      // Form Data
      let form_data = $(e.target).serialize();
      var fakeURL = "http://www.example.com/?" + form_data;
      var createURL = new URL(fakeURL);
      role = createURL.searchParams.get("role")

      // DO AJAX HERE
      let ajax = setTimeout(function() {
        $.ajax({
          type: "POST",
          url: "<?=base_url('role/store');?>",
          dataType: "JSON",
          data: {
            role: role,
          },
          success: function(data) {
            if ($.isEmptyObject(data.error)) {
              swal('Berhasil', 'Role baru ditambahkan!', 'success');
            } else {
              alert(data.error);
            }
          }
        });
        $('input[name="role"]').val("");
        modal.modal('hide');
        form.stopProgress();
        setTimeout(function() {
          location.reload();
        }, 1500)
        clearInterval(ajax);
      }, 1500);

      e.preventDefault();
    },
    shown: function(modal, form) {},
    buttons: [{
      text: 'Simpan',
      submit: true,
      class: 'btn btn-primary btn-shadow',
      handler: function(modal) {}
    }]
  });

  // btn Edit
  $('.modal-role').click(function() {
    var role = $(this).attr('data-role');
    var id_role = $(this).attr('data-id-role');
    $('input[name="role"]').val(role);
    $('input[name="id_role"]').val(id_role);
    $('#modalEditRole').modal('show');
  });

  // btn Edit Simpan
  $('#btnSimpan').click(function(event) {
    event.preventDefault();
    var role = $('input[name="role"]').val();
    var id_role = $('input[name="id_role"]').val();
    $.ajax({
      type: "POST",
      url: "<?=base_url('role/update');?>",
      dataType: "JSON",
      data: {
        id_role: id_role,
        role: role
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {
          $('#modalEditRole').modal('hide');
          swal('Berhasil', 'Role berhasil diubah!', 'success');
          setTimeout(function() {
            location.reload();
          }, 1500)
        } else {
          alert(data.error);
        }
      }
    });
  });


  // btn Delete
  $('.modal-delete-role').click(function() {
    var role = $(this).attr('data-role');
    var id_role = $(this).attr('data-id-role');

    $('#nama_role').text(role);
    $('input[name="id_role_delete"]').val(id_role);
    $('#modalHapusRole').modal('show');
  });

  // btn Delete Simpan
  $('#btnDelete').click(function(event) {
    event.preventDefault();
    var id_role = $('input[name="id_role_delete"]').val();
    $.ajax({
      type: "POST",
      url: "<?=base_url('role/delete');?>",
      dataType: "JSON",
      data: {
        id_role: id_role
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {
          $('#modalHapusRole').modal('hide');
          swal('Berhasil', 'Role berhasil dihapus!', 'success');
          setTimeout(function() {
            location.reload();
          }, 1500)
        } else {
          alert(data.error);
        }
      }
    });
  });
});
</script>