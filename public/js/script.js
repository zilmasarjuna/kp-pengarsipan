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
    $(".hidden").hide();
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
        $("#fullname").val(data.data_acc.fullname);
        $("#no_telp").val(data.data_acc.no_telp);
        $("#address").val(data.data_acc.address);
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
    $("#listData").children().remove();
    $.ajax({
      url: 'http://localhost/mvc/public/tasks/getubah',
      data: {
        id: id,
      },
      method: 'post',
      dataType: 'json',
      success: function(data) {
        $("#idUpload").val(data.id);
        $("#task_name").text(data.name);
        $("#task_description").text(data.description);
        $("#task_tgl").text(data.tgl_deadline);

        $.fn.addNewRow = function (row) {
          $(this).append("<li><a class='d-flex align-items-center text-muted text-hover-primary py-1 f-12' href='"+window.location.origin+"/mvc/public"+row.path_name+"' download>"+ row.filename +"</a></li>");
        }

        if (data.files.length === 0) {
          $("#listData").append("<li class='text-danger'>File masih kosong</li>");
        }
        for (var i = 0; i < data.files.length; i++) {
          $("#listData").addNewRow(data.files[i]);
        }
      }
    });
  });


  $("#fileUpload").change(function() {
    var i = $(this).prev('label').clone();
		var file = $('#fileUpload')[0].files[0].name;
		$(this).prev('label').text(file);
  })
})


