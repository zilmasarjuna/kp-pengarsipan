$(function() {
  $('.tampilModalTambah').on('click', function() {
    $('#formModalLabel').html('Tambah Data Mahasiswa');
    $('.modal-footer button[type=submit]').html('Tambah Data');
  })
  
  $('.tampilModalUbah').on('click', function() {
    $('#formModalLabel').html('Ubah Data Mahasiswa');

    $('.modal-footer button[type=submit]').html('Ubah Data');
    $('.form1').attr('action', 'http://localhost/mvc/public/mahasiswa/ubah');
    var id = $(this).data('id');
    $.ajax({
      url: 'http://localhost/mvc/public/mahasiswa/getubah',
      data: {
        id: id,
      },
      method: 'post',
      dataType: 'json',
      success: function(data) {
        $("#nama").val(data.nama);
        $("#email").val(data.email);
        $("#jurusan").val(data.jurusan);
        $("#id").val(data.id);
      }
    });
  })

  $('.addModal').on('click', function() {
    $('#formModalLabel').html('Tambah Data User');
    $('.modal-footer button[type=submit]').html('Tambah Data');
    $('.form1').attr('action', 'http://localhost/mvc/public/user/add');
    $("#username").val('');
    $("#password").val('');
    $("#role_id").val('');
    $("#id").val('');
  })

  $('.modalUbahUser').on('click', function() {
    $('#formModalLabel').html('Ubah Data User');

    $('.modal-footer button[type=submit]').html('Ubah Data');
    $('.form1').attr('action', 'http://localhost/mvc/public/user/ubah');
    var id = $(this).data('id');
    $.ajax({
      url: 'http://localhost/mvc/public/user/getubah',
      data: {
        id: id,
      },
      method: 'post',
      dataType: 'json',
      success: function(data) {
        $("#username").val(data.username);
        $("#password").val(data.pasword);
        $("#role_id").val(data.role_id);
        $("#id").val(data.id);
      }
    });
  });

  $('.modalUbahTask').on('click', function() {
    $('#formModalLabel').html('Ubah Data Task');
    $('.modal-footer button[type=submit]').html('Ubah Data');
    $('.form1').attr('action', 'http://localhost/mvc/public/tasks/ubah');
    var id = $(this).data('id');
    $.ajax({
      url: 'http://localhost/mvc/public/tasks/getubah',
      data: {
        id: id,
      },
      method: 'post',
      dataType: 'json',
      success: function(data) {
        $("#name").val(data.name);
        $("#description").val(data.description);
        $("#tgl_deadline").val(data.tgl_deadline);
        $("#staff").val(data.staff);
        $("#client").val(data.client);
        $("#id").val(data.id);
      }
    });
  });

  $('.addModalTask').on('click', function() {
    $('#formModalLabel').html('Tambah Data Task');
    $('.form1').attr('action', 'http://localhost/mvc/public/tasks/add');
    $('.modal-footer button[type=submit]').html('Tambah Data');
    $("#name").val('');
    $("#description").val('');
    $("#tgl_deadline").val('');
    $("#staff").val('');
    $("#client").val('');
    $("#id").val('');
  })

  $('.modalUploadTask').on('click', function() {
    var id = $(this).data('id');
    $.ajax({
      url: 'http://localhost/mvc/public/tasks/getubah',
      data: {
        id: id,
      },
      method: 'post',
      dataType: 'json',
      success: function(data) {
        console.log(data);
        $("#idUpload").val(data.id);
      }
    });
  });
})


