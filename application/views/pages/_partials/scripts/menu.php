<script type="text/javascript">
$(document).ready(function() {
  $("#table-menu").dataTable({
    "columnDefs": [{
      "sortable": true,
      "targets": [0, 1]
    }]
  });

  // Modal tambah Menu
  $("#newMenuModal").fireModal({
    title: 'Tambah Menu',
    body: $("#modal-menu"),
    footerClass: 'bg-whitesmoke',
    autoFocus: false,
    onFormSubmit: function(modal, e, form) {
      // Form Data
      let form_data = $(e.target).serialize();
      var fakeURL = "http://www.example.com/?" + form_data;
      var createURL = new URL(fakeURL);
      menu = createURL.searchParams.get("menu")

      // DO AJAX HERE
      let ajax = setTimeout(function() {
        $.ajax({
          type: "POST",
          url: "<?=base_url('menu/store');?>",
          dataType: "JSON",
          data: {
            menu: menu,
          },
          success: function(data) {
            if ($.isEmptyObject(data.error)) {
              swal('Berhasil', 'Menu baru ditambahkan!', 'success');
            } else {
              alert(data.error);
            }
          }
        });
        $('input[name="menu"]').val("");
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
  $('.modal-menu').click(function() {
    var menu = $(this).attr('data-menu');
    var id_menu = $(this).attr('data-id-menu');
    $('input[name="menu"]').val(menu);
    $('input[name="id_menu"]').val(id_menu);
    $('#modalEditMenu').modal('show');
  });

  // btn Edit Simpan
  $('#btnSimpan').click(function(event) {
    event.preventDefault();
    var menu = $('input[name="menu"]').val();
    var id_menu = $('input[name="id_menu"]').val();
    $.ajax({
      type: "POST",
      url: "<?=base_url('menu/update');?>",
      dataType: "JSON",
      data: {
        id_menu: id_menu,
        menu: menu
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {
          $('#modalEditMenu').modal('hide');
          swal('Berhasil', 'Menu berhasil diubah!', 'success');
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
  $('.modal-delete-menu').click(function() {
    var menu = $(this).attr('data-menu');
    var id_menu = $(this).attr('data-id-menu');

    $('#nama_menu').text(menu);
    $('input[name="id_menu_delete"]').val(id_menu);
    $('#modalHapusMenu').modal('show');
  });

  // btn Delete Simpan
  $('#btnDelete').click(function(event) {
    event.preventDefault();
    var id_menu = $('input[name="id_menu_delete"]').val();
    $.ajax({
      type: "POST",
      url: "<?=base_url('menu/delete');?>",
      dataType: "JSON",
      data: {
        id_menu: id_menu
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {
          $('#modalHapusMenu').modal('hide');
          swal('Berhasil', 'Menu berhasil dihapus!', 'success');
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