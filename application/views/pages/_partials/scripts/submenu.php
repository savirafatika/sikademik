<script type="text/javascript">
$(document).ready(function() {
  $("#table-submenu").dataTable({
    "columnDefs": [{
      "sortable": true,
      "targets": [0, 1, 2, 3, 4, 5]
    }]
  });

  // show_sub_menu(); //call function show all product

  //function show all product
  function show_sub_menu() {
    $.ajax({
      type: 'ajax',
      url: '<?=base_url('menu/get_sub_menu');?>',
      async: true,
      dataType: 'json',
      success: function(data) {
        var html = '';
        var i;
        for (i = 0; i < data.length; i++) {
          let status = '-';
          if (data[i].is_active == 1) {
            status = 'Aktif';
          } else {
            status = 'Tidak Aktif';
          }
          html += '<tr>' +
            '<td>' + data[i].title + '</td>' +
            '<td>' + data[i].menu + '</td>' +
            '<td>' + data[i].url + '</td>' +
            '<td>' + data[i].icon + '</td>' +
            '<td>' + status + '</td>' +
            '<td>' +
            '<a href="javascript:void(0);" class="badge badge-success item_edit" data-id-menu="' + data[
              i].id + '" data-title="' + data[i].title + '"  data-url="' + data[
              i].url + '" data-icon="' + data[i].icon + '"  data-menu-id="' + data[
              i].menu_id + '" data-status="' + data[i].is_active + '"><i class="fas fa-edit"></i> Edit</a>' +
            ' ' +
            '<a href="javascript:void(0);" class="badge badge-danger item_delete" data-menu="' + data[
              i].title + '" data-id-menu="' +
            data[i].id + '"><i class="fas fa-trash"></i> Delete</a>' +
            '</td>' +
            '</tr>';
        }
        $('#show_data').html(html);
      }

    });
  }

  //Save sub menu
  $('#btnSimpanSubMenu').on('click', function(e) {
    e.preventDefault();
    var isEdit = $('input[name="id_sub_menu"]').val();
    var title = $('input[name="title"]').val();
    var url = $('input[name="url"]').val();
    var icon = $('input[name="icon"]').val();
    var menu_id = $('#menu_id').find(":selected").val();
    var is_active = $('#is_active').is(":checked");

    var action = '<?=base_url('menu/storeSubMenu');?>';
    var message = 'ditambahkan!';
    if (isEdit) {
      action = '<?=base_url('menu/updateSubMenu');?>';
      message = 'diubah!';
    }

    $.ajax({
      type: "POST",
      url: action,
      dataType: "JSON",
      data: {
        id: isEdit,
        menu_id: menu_id,
        title: title,
        url: url,
        icon: icon,
        is_active: is_active ? 1 : 0
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {
          var title = $('input[name="title"]').val("");
          var url = $('input[name="url"]').val("");
          var icon = $('input[name="icon"]').val("");
          var menu_id = $('#menu_id').prop('selectedIndex', 0);
          var is_active = $('#is_active').removeAttr('checked');
          $('#modalSubMenu').modal('hide');
          swal('Berhasil', `Sub Menu berhasil ${message}`, 'success');
          show_sub_menu();
        } else {
          alert(data.error);
        }
      }
    });
    return false;
  });

  //delete record to database
  $('#btn_delete').on('click', function() {
    var id = $('[name="id_sub_menu_delete"]').val();
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('menu/deleteSubMenu'); ?>",
      dataType: "JSON",
      data: {
        id_sub_menu: id
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {
          $('[name="id_sub_menu_delete"]').val("");
          $('#modalHapusSubMenu').modal('hide');
          swal('Berhasil', 'Sub Menu berhasil dihapus!', 'success');
          show_sub_menu();
        } else {
          alert(data.error);
        }
      }
    });
    return false;
  });

  // add modal
  $("#newSubMenuModal").click(function(e) {
    e.preventDefault()
    $('[name="id_sub_menu"]').remove();
    $('[name="title"]').val("");
    $('[name="url"]').val("");
    $('[name="icon"]').val("");
    $("#menu_id").val("");
    $("#is_active").prop('checked', true);
    $('#modalSubMenu').modal('show');
  })
  // edit modal
  $('#show_data').on('click', '.item_edit', function(e) {
    e.preventDefault()
    var id = $(this).data('id-menu');
    $('#isEdit').prepend(`<input type="hidden" name="id_sub_menu" value="${id}" />`);
    var title = $(this).data('title');
    var url = $(this).data('url');
    var icon = $(this).data('icon');
    var menu_id = $(this).data('menu-id');
    var status = $(this).data('status');
    $('#modalSubMenu').modal('show');
    $('[name="title"]').val(title);
    $('[name="url"]').val(url);
    $('[name="icon"]').val(icon);
    $("#menu_id option:selected").prop("selected", false);
    $(`#menu_id option[value='${menu_id}']`).prop('selected', true);

    if (status == 1) {
      $("#is_active").prop('checked', true);
    } else {
      $("#is_active").prop('checked', false);
    }
  })

  // delete modal
  $('#show_data').on('click', '.item_delete', function() {
    var id = $(this).data('id-menu');
    var name = $(this).data('title');

    $('#modalHapusSubMenu').modal('show');
    $('#nama_sub_menu').text(name);
    $('[name="id_sub_menu_delete"]').val(id);
  });
})
</script>