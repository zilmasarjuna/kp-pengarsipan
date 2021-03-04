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
    $("#idTask").val(id);
    $("#listData").children().remove();
    $("#listDataFeedback").children().remove();
    $('.modal-footer button[type=submit]').html('Save Data');
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
          var status = row.show_client === "1" ? "- ditampilkan client" : "- tidak ditampilkan client";
          switch(session.role_name) {
            case 'konsultan':
              $(this).append("<li><a class='d-flex align-items-center text-muted text-hover-primary py-1 f-12' href='"+window.location.origin+"/mvc/public"+row.path_name+"' download><div>"+ row.filename + "</div><div><span>"+ row.date_created +" -  " + row.username +" " + status + "</span></div></a><a href='"+window.location.origin+"/mvc/public/tasks/deleteFile/"+row.id+"' class='badge badge-danger mr-2'>Delete</a><a href='"+window.location.origin+"/mvc/public/tasks/showFileClient/"+row.id+"' class='badge badge-success'>tampilkan ke client</a></li>");
              break;
            case 'staff':
              $(this).append("<li><a class='d-flex align-items-center text-muted text-hover-primary py-1 f-12' href='"+window.location.origin+"/mvc/public"+row.path_name+"' download><div>"+ row.filename + "</div><div><span>"+ row.date_created +" -  "+ row.username +"</span></div></a></li>");
              break;
            default:
              $(this).append("<li><a class='d-flex align-items-center text-muted text-hover-primary py-1 f-12' href='"+window.location.origin+"/mvc/public"+row.path_name+"' download><div>"+ row.filename + "</div><div><span>"+ row.date_created +"</span></div></a></li>");
              break;
          }
        }

        $.fn.addNewFeedbackRow = function (row) {
          switch(session.role_name) {
            case 'konsultan':
              $(this).append("<li>"+ row.description +"</li>");
              break;
            case 'staff':
              $(this).append("<li>"+ row.description +"</li>");
              break;
            default:
              $(this).append("<li>"+ row.description +"</li>");
              break;
          }
        }

        if (data.files.length === 0) {
          $("#listData").append("<li class='text-danger'>File masih kosong</li>");
        }
        for (var i = 0; i < data.files.length; i++) {
          $("#listData").addNewRow(data.files[i]);
        }
        for (var i = 0; i < data.feedback.length; i++) {
          $("#listDataFeedback").addNewFeedbackRow(data.feedback[i]);
        }
      }
    });
  });

  $('.modalUploadClientTask').on('click', function() {
    var id = $(this).data('id');
    $("#idTask").val(id);
    $("#listDataBerkas").children().remove();
    $("#listDataFeedback").children().remove();
    $('.modal-footer button[type=submit]').html('Save Data');
    $.ajax({
      url: 'http://localhost/mvc/public/tasks/getubahberkas',
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
          var status = row.show_client === "1" ? "- ditampilkan client" : "- tidak ditampilkan client";
          switch(session.role_name) {
            case 'konsultan':
              $(this).append("<li><a class='d-flex align-items-center text-muted text-hover-primary py-1 f-12' href='"+window.location.origin+"/mvc/public"+row.path_name+"' download><div>"+ row.filename + "</div><div><span>"+ row.date_created +" -  " + row.username +" " + status + "</span></div></a><a href='"+window.location.origin+"/mvc/public/tasks/deleteFile/"+row.id+"' class='badge badge-danger mr-2'>Delete</a><a href='"+window.location.origin+"/mvc/public/tasks/showFileClient/"+row.id+"' class='badge badge-success'>tampilkan ke client</a></li>");
              break;
            case 'staff':
              $(this).append("<li><a class='d-flex align-items-center text-muted text-hover-primary py-1 f-12' href='"+window.location.origin+"/mvc/public"+row.path_name+"' download><div>"+ row.filename + "</div><div><span>"+ row.date_created +" -  "+ row.username +"</span></div></a></li>");
              break;
            default:
              $(this).append("<li><a class='d-flex align-items-center text-muted text-hover-primary py-1 f-12' href='"+window.location.origin+"/mvc/public"+row.path_name+"' download><div>"+ row.filename + "</div><div><span>"+ row.date_created +"</span></div></a></li>");
              break;
          }
        }

        $.fn.addNewFeedbackRow = function (row) {
          switch(session.role_name) {
            case 'konsultan':
              $(this).append("<li>"+ row.description +"</li>");
              break;
            case 'staff':
              $(this).append("<li>"+ row.description +"</li>");
              break;
            default:
              $(this).append("<li>"+ row.description +"</li>");
              break;
          }
        }

        if (data.files.length === 0) {
          $("#listDataBerkas").append("<li class='text-danger'>File masih kosong</li>");
        }
        for (var i = 0; i < data.files.length; i++) {
          $("#listDataBerkas").addNewRow(data.files[i]);
        }
        for (var i = 0; i < data.feedback.length; i++) {
          $("#listDataFeedback").addNewFeedbackRow(data.feedback[i]);
        }
      }
    });
  });


  $("#fileUpload").change(function() {
    var i = $(this).prev('label').clone();
		var file = $('#fileUpload')[0].files[0].name;
		$(this).prev('label').text(file);
  })

  $('.printReport').on('click', function() {
    var pdf = new jsPDF('p', 'pt', 'letter');
    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
    source = $('#table');
    specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector
        '#table': function(element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true
        }
    };
    margins = {
        top: 80,
        bottom: 60,
        left: 40,
        width: 522
    };
    // all coords and widths are in jsPDF instance's declared units
    // 'inches' in this case
    pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, {// y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },
    function(dispose) {
        // dispose: object with X, Y of the last line add to the PDF 
        //          this allow the insertion of new lines after html
        pdf.save('Test.pdf');
    }
    , margins)
  })
})

$(document).ready(function() {
  $('#example').DataTable( {
      dom: 'Bfrtip',
      buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
      ]
  } );
});

function getDate(date) {
  var d = new Date(date);
  var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };

  var datestring = d.getDate()  + "-" + (d.getMonth()+1) + "-" + d.getFullYear() + " " +
  d.getHours() + ":" + d.getMinutes();

  return datestring;
}

