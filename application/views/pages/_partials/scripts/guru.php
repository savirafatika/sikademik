<script type="text/javascript">
$(document).ready(function() {
  $("#table-guru").dataTable({
    "columnDefs": [{
      "sortable": true,
      "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
    }]
  });

  // show_guru(); //call function show all product

  //function show all product
  function show_guru() {
    $.ajax({
      type: 'ajax',
      url: '<?=base_url('guru/getGuru');?>',
      async: true,
      dataType: 'json',
      success: function(data) {
        var html = '';
        var i;
        var no = 1;
        for (i = 0; i < data.length; i++) {
          html += '<tr>' +
            '<td>' + no++ + '</td>' +
            '<td>' + data[i].NIP + '</td>' +
            '<td>' + data[i].nama + '</td>' +
            '<td>' + data[i].tempat_lahir + '</td>' +
            '<td>' + data[i].tanggal_lahir + '</td>' +
            '<td>' + data[i].jenis_kelamin + '</td>' +
            '<td>' + data[i].agama + '</td>' +
            '<td>' + data[i].status_perkawinan + '</td>' +
            '<td>' + data[i].alamat + '</td>' +
            '<td>' + data[i].nama_perguruan_tinggi + '</td>' +
            '<td>' + data[i].jurusan + '</td>' +
            '<td>' + data[i].tahun_lulus + '</td>' +
            '<td>' + data[i].golongan + '</td>' +
            '<td>' + data[i].keterangan + '</td>' +
            '<td>' +
            '<a href="javascript:void(0);" class="badge badge-success item_edit_guru" data-id-guru="' +
            data[
              i].NIP + '" data-nama="' + data[i].nama + '" data-tempat_lahir="' + data[
              i].tempat_lahir + '" data-tanggal_lahir="' + data[
              i].tanggal_lahir + '" data-jenis-kelamin="' + data[i].jenis_kelamin +
            '" data-status_perkawinan="' +
            data[
              i].status_perkawinan + '" data-nama_perguruan_tinggi="' + data[
              i].nama_perguruan_tinggi + '" data-jurusan="' + data[
              i].jurusan + '" data-tahun_lulus="' + data[
              i].tahun_lulus + '" data-golongan="' + data[
              i].golongan + '" data-keterangan="' + data[
              i].keterangan + '" data-agama="' + data[
              i].agama + '" data-alamat="' + data[i].alamat + '"><i class="fas fa-edit"></i> Edit</a>' +
            ' ' +
            '<a href="javascript:void(0);" class="badge badge-danger item_delete_guru" data-nama="' + data[
              i].nama + '" data-id-guru="' +
            data[i].NIP + '"><i class="fas fa-trash"></i> Delete</a>' +
            '</td>' +
            '</tr>';
        }
        $('#show_data').html(html);
      }

    });
  }

  //btn simpan guru
  $('#btnSimpanGuru').on('click', function(e) {
    e.preventDefault();
    var isEdit = $('input[name="id_guru"]').val();
    var nip = $('input[name="nip"]').val();
    var nama = $('input[name="nama"]').val();
    var tempat_lahir = $('input[name="tempat_lahir"]').val();
    var tanggal_lahir = $('input[name="tanggal_lahir"]').val();
    var jenis_kelamin = $("input[name='jenis_kelamin']:checked").val();
    var agama = $('#agama').find(":selected").val();
    var status_perkawinan = $('#status_perkawinan').find(":selected").val();
    var nama_perguruan_tinggi = $('input[name="nama_perguruan_tinggi"]').val();
    var jurusan = $('input[name="jurusan"]').val();
    var tahun_lulus = $('input[name="tahun_lulus"]').val();
    var golongan = $('#golongan').find(":selected").val();
    var keterangan = $('input[name="keterangan"]').val();
    var alamat = $('textarea#alamat').val();

    var action = '<?=base_url('guru/store');?>';
    var message = 'ditambahkan!';
    if (isEdit) {
      action = '<?=base_url('guru/update');?>';
      message = 'diubah!';
    }

    $.ajax({
      type: "POST",
      url: action,
      dataType: "JSON",
      data: {
        nip: nip,
        id_guru: isEdit,
        nama: nama,
        tempat_lahir: tempat_lahir,
        tanggal_lahir: tanggal_lahir,
        agama: agama,
        status_perkawinan: status_perkawinan,
        nama_perguruan_tinggi: nama_perguruan_tinggi,
        jurusan: jurusan,
        tahun_lulus: tahun_lulus,
        golongan: golongan,
        keterangan: keterangan,
        alamat: alamat,
        jenis_kelamin: jenis_kelamin
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {
          $('[name="nip"]').val("");
          $('[name="nama"]').val("");
          $('[name="tempat_lahir"]').val("");
          $('[name="tanggal_lahir"]').val("");
          $('#agama').prop('selectedIndex', 0);
          $('#status_perkawinan').prop('selectedIndex', 0);
          $('#golongan').prop('selectedIndex', 0);
          $('[name="jenis_kelamin"]').attr("checked", false);
          $('[name="nama_perguruan_tinggi"]').val("");
          $('[name="jurusan"]').val("");
          $('[name="tahun_lulus"]').val("");
          $('[name="keterangan"]').val("");
          $('textarea#alamat').val("");
          $('#modalGuru').modal('hide');
          swal('Berhasil', `Guru berhasil ${message}`, 'success');
          show_guru();
        } else {
          alert(data.error);
        }
      }
    });
    return false;
  });

  //delete record to database
  $('#btn_delete_guru').on('click', function() {
    var id = $('[name="id_guru_delete"]').val();
    $.ajax({
      type: "POST",
      url: "<?=base_url('guru/delete');?>",
      dataType: "JSON",
      data: {
        nip: id
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {
          $('[name="id_guru_delete"]').val("");
          $('#modalHapusGuru').modal('hide');
          swal('Berhasil', 'Guru berhasil dihapus!', 'success');
          show_guru();
        } else {
          alert(data.error);
        }
      }
    });
    return false;
  });

  // btn add modal
  $("#newGuruModal").click(function(e) {
    e.preventDefault()
    $('[name="id_guru"]').remove();
    $('[name="nip"]').val("");
    $('[name="nama"]').val("");
    $('[name="tempat_lahir"]').val("");
    $('[name="tanggal_lahir"]').val("");
    $('[name="jenis_kelamin"]').attr("checked", false);
    $('[name="agama"]').val("");
    $('[name="status_perkawinan"]').val("");
    $('[name="nama_perguruan_tinggi"]').val("");
    $('[name="jurusan"]').val("");
    $('[name="tahun_lulus"]').val("");
    $('[name="golongan"]').val("");
    $('[name="keterangan"]').val("");
    $('textarea#alamat').val("");
    $(".modal-title").html('Tambah Guru')
    $('#modalGuru').modal('show');
  })
  // btn edit modal
  $('#show_data').on('click', '.item_edit_guru', function(e) {
    e.preventDefault()
    $(".modal-title").html('Edit Guru')
    var id = $(this).data('id-guru');
    $('#isEdit').prepend(`<input type="hidden" name="id_guru" value="${id}" />`);
    var nip = id;
    var nama = $(this).data('nama');
    var tempat_lahir = $(this).data('tempat_lahir');
    var tanggal_lahir = $(this).data('tanggal_lahir');
    var jenis_kelamin = $(this).data('jenis-kelamin');
    var agama = $(this).data('agama');
    var status_perkawinan = $(this).data('status_perkawinan');
    var nama_perguruan_tinggi = $(this).data('nama_perguruan_tinggi');
    var jurusan = $(this).data('jurusan');
    var tahun_lulus = $(this).data('tahun_lulus');
    var golongan = $(this).data('golongan');
    var keterangan = $(this).data('keterangan');
    var alamat = $(this).data('alamat');
    $('[name="nip"]').val(nip);
    $('[name="nama"]').val(nama);
    $('[name="tempat_lahir"]').val(tempat_lahir);
    $('[name="tanggal_lahir"]').val(tanggal_lahir);
    $('[name="nama_perguruan_tinggi"]').val(nama_perguruan_tinggi);
    $('[name="jurusan"]').val(jurusan);
    $('[name="tahun_lulus"]').val(tahun_lulus);
    $('[name="keterangan"]').val(keterangan);
    $('textarea#alamat').val(alamat);
    $("#status_perkawinan option:selected").prop("selected", false);
    $(`#status_perkawinan option[value='${status_perkawinan}']`).prop('selected', true);

    $("#agama option:selected").prop("selected", false);
    $(`#agama option[value='${agama}']`).prop('selected', true);

    $("#golongan option:selected").prop("selected", false);
    $(`#golongan option[value='${golongan}']`).prop('selected', true);

    $('[name="jenis_kelamin"]').attr("checked", false);
    $(`input:radio[name="jenis_kelamin"][value="${jenis_kelamin}"]`).attr('checked', true);

    $('#modalGuru').modal('show');
  })

  // btn delete modal
  $('#show_data').on('click', '.item_delete_guru', function() {
    var id = $(this).data('id-guru');
    var name = $(this).data('nama');

    $('#modalHapusGuru').modal('show');
    $('#nama_guru').text(name);
    $('[name="id_guru_delete"]').val(id);
  });
})
</script>