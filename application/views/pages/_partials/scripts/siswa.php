<script type="text/javascript">
$(document).ready(function() {
  $("#table-siswa").dataTable({
    "columnDefs": [{
      "sortable": true,
      "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8]
    }]
  });

  // btn lihat kelas
  $('#show_data').on('click', '.item_lihat_siswa', function(e) {
    e.preventDefault()
    var id = $(this).data('id-kelas');
    let url = `<?=base_url('siswa/data_siswa/');?>${id}`;
    window.location.replace(url);
  })

  //btn simpan siswa
  $('#btnSimpanSiswa').on('click', function(e) {
    e.preventDefault();
    var id = "<?=$this->uri->segment(3);?>"
    var isEdit = $('input[name="id_siswa"]').val();
    var nis = $('input[name="nis"]').val();
    var nama = $('input[name="nama"]').val();
    var tempat_lahir = $('input[name="tempat_lahir"]').val();
    var tanggal_lahir = $('input[name="tanggal_lahir"]').val();
    var jenis_kelamin = $("input[name='jenis_kelamin']:checked").val();
    var agama = $('#agama').find(":selected").val();
    var nama_ayah = $('input[name="nama_ayah"]').val();
    var nama_ibu = $('input[name="nama_ibu"]').val();
    var pekerjaan_ayah = $('input[name="pekerjaan_ayah"]').val();
    var pekerjaan_ibu = $('input[name="pekerjaan_ibu"]').val();
    var alamat = $('textarea#alamat').val();

    var action = '<?=base_url('siswa/store');?>';
    var message = 'ditambahkan!';
    if (isEdit) {
      action = '<?=base_url('siswa/update');?>';
      message = 'diubah!';
    }

    $.ajax({
      type: "POST",
      url: action,
      dataType: "JSON",
      data: {
        kelas_id: id,
        nis: nis,
        id_siswa: isEdit,
        nama: nama,
        tempat_lahir: tempat_lahir,
        tanggal_lahir: tanggal_lahir,
        agama: agama,
        nama_ayah: nama_ayah,
        nama_ibu: nama_ibu,
        pekerjaan_ayah: pekerjaan_ayah,
        pekerjaan_ibu: pekerjaan_ibu,
        alamat: alamat,
        jenis_kelamin: jenis_kelamin
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {
          $('[name="nis"]').val("");
          $('[name="nama"]').val("");
          $('[name="tempat_lahir"]').val("");
          $('[name="tanggal_lahir"]').val("");
          $('#agama').prop('selectedIndex', 0);
          $('[name="jenis_kelamin"]').attr("checked", false);
          $('[name="nama_ayah"]').val("");
          $('[name="nama_ibu"]').val("");
          $('[name="pekerjaan_ayah"]').val("");
          $('[name="pekerjaan_ibu"]').val("");
          $('textarea#alamat').val("");
          $('#modalSiswa').modal('hide');
          swal('Berhasil', `Siswa berhasil ${message}`, 'success');
          window.location.reload()
        } else {
          alert(data.error);
        }
      }
    });
    return false;
  });

  //delete record to database
  $('#btn_delete_siswa').on('click', function() {
    var id = $('[name="id_siswa_delete"]').val();
    $.ajax({
      type: "POST",
      url: "<?=base_url('siswa/delete');?>",
      dataType: "JSON",
      data: {
        nis: id
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {
          $('[name="id_siswa_delete"]').val("");
          $('#modalHapusSiswa').modal('hide');
          swal('Berhasil', 'Siswa berhasil dihapus!', 'success');
          window.location.reload()
        } else {
          alert(data.error);
        }
      }
    });
    return false;
  });

  // btn add modal
  $("#newSiswaModal").click(function(e) {
    e.preventDefault()
    $('[name="id_siswa"]').remove();
    $('[name="nis"]').val("");
    $('[name="nama"]').val("");
    $('[name="tempat_lahir"]').val("");
    $('[name="tanggal_lahir"]').val("");
    $('[name="jenis_kelamin"]').attr("checked", false);
    $('[name="agama"]').val("");
    $('[name="nama_ayah"]').val("");
    $('[name="nama_ibu"]').val("");
    $('[name="pekerjaan_ayah"]').val("");
    $('[name="pekerjaan_ibu"]').val("");
    $('textarea#alamat').val("");
    $('#modalSiswa').modal('show');
  })
  // btn edit modal
  $('#show_data').on('click', '.item_edit_siswa', function(e) {
    e.preventDefault()
    var id = $(this).data('id-siswa');
    $('#isEdit').prepend(`<input type="hidden" name="id_siswa" value="${id}" />`);
    var nis = id;
    var nama = $(this).data('nama');
    var tempat_lahir = $(this).data('tempat_lahir');
    var tanggal_lahir = $(this).data('tanggal_lahir');
    var jenis_kelamin = $(this).data('jenis-kelamin');
    var agama = $(this).data('agama');
    var nama_ayah = $(this).data('nama_ayah');
    var nama_ibu = $(this).data('nama_ibu');
    var pekerjaan_ayah = $(this).data('pekerjaan_ayah');
    var pekerjaan_ibu = $(this).data('pekerjaan_ibu');
    var alamat = $(this).data('alamat');
    $('[name="nis"]').val(nis);
    $('[name="nama"]').val(nama);
    $('[name="tempat_lahir"]').val(tempat_lahir);
    $('[name="tanggal_lahir"]').val(tanggal_lahir);
    $('[name="nama_ayah"]').val(nama_ayah);
    $('[name="nama_ibu"]').val(nama_ibu);
    $('[name="pekerjaan_ayah"]').val(pekerjaan_ayah);
    $('[name="pekerjaan_ibu"]').val(pekerjaan_ibu);
    $('textarea#alamat').val(alamat);
    $("#agama option:selected").prop("selected", false);
    $(`#agama option[value='${agama}']`).prop('selected', true);
    $('[name="jenis_kelamin"]').attr("checked", false);
    $(`input:radio[name="jenis_kelamin"][value="${jenis_kelamin}"]`).attr('checked', true);
    $('#modalSiswa').modal('show');
  })

  // btn delete modal
  $('#show_data').on('click', '.item_delete_siswa', function() {
    var id = $(this).data('id-siswa');
    var name = $(this).data('nama');

    $('#modalHapusSiswa').modal('show');
    $('#nama_siswa').text(name);
    $('[name="id_siswa_delete"]').val(id);
  });
})
</script>