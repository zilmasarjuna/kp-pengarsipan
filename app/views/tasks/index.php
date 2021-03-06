<div class="container mt-3">
  <div class="row">
    <div class="col-lg-12">
      <?php Flasher::flash(); ?>
    </div>
  </div>
</div>

<div class="user-list">
  <div class="subheader py-2 py-lg-4 subheader-transparent">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
      <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Tasks</h5>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <div class="card-title">
          <h5>Tasks Management</h5>
        </div>
        <div class="card-toolbar">
        <?php if ($_SESSION['user']['role_name'] === 'konsultan') echo ' 
          <button type="button" class="btn btn-primary font-weight-bolder cetakModal mr-3" data-toggle="modal" data-target="#formModalCetak">
            Cetak Data
          </button>
          <button type="button" class="btn btn-primary font-weight-bolder addModalTask" data-toggle="modal" data-target="#formModal">
            New Record
          </button>' ?>
        </div>
      </div>
      <div class="card-body">
        <?php if (count($data['tasks']) > 0):?>
          <table class="table display nowrap" id="example">
            <thead>
              <tr>
                <th>#</th>
                <th>Task</th>
                <?php if ($_SESSION['user']['role_name'] !== 'staff') echo '<th>Staff</th>' ?>
                <?php if ($_SESSION['user']['role_name'] !== 'clients') echo '<th>Client</th>' ?>
                <th>Deadline</th>
                <th>Status</th>
                <th>Berkas Client</th>
                <?php if ($_SESSION['user']['role_name'] !== 'clients') echo '<th>Action</th>' ?>
                <?php if ($_SESSION['user']['role_name'] === 'clients') echo '<th>Hasil</th>' ?>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data['tasks'] as $usr => $index) : ?>
                <tr>
                  <td><?= $usr+1 ?></td>
                  <td><?= $data['tasks'][$usr]['name']; ?></td>
                  <?php if ($_SESSION['user']['role_name'] !== 'staff') echo '<td>'. $data['tasks'][$usr]['staff'] .'.</td>' ?>
                  <?php if ($_SESSION['user']['role_name'] !== 'clients') echo '<td>'. $data['tasks'][$usr]['client'] .'.</td>' ?>

                  <td><?= $data['tasks'][$usr]['tgl_deadline']; ?></td>
                  <td><?= $data['tasks'][$usr]['status']; ?></td>
                  <?php if ($_SESSION['user']['role_name'] === 'clients') echo '<td><a href="'. BASEURL .'/tasks/change/'.$data['tasks'][$usr]['id'].'" class="badge badge-success modalUploadClientTask" data-toggle="modal" data-target="#formModalClientUpload" data-id="'.$data['tasks'][$usr]['id'].'">Upload</td>'; ?>
                  <?php if ($_SESSION['user']['role_name'] !== 'clients') echo '<td><a href="'. BASEURL .'/tasks/change/'.$data['tasks'][$usr]['id'].'" class="badge badge-success modalUploadClientTask" data-toggle="modal" data-target="#formModalClientUpload" data-id="'.$data['tasks'][$usr]['id'].'">Detail</td>'; ?>


                  <?php if ($_SESSION['user']['role_name'] === 'konsultan') echo '<td><a href="'. BASEURL .'/tasks/delete/'. $data['tasks'][$usr]['id'] .'" class="badge badge-danger mr-1" onclick="return confirm("yakin?")">hapus</a>
                      <a href="'. BASEURL .'/tasks/change/'. $data['tasks'][$usr]['id'] .'" class="badge badge-warning mr-1 modalUbahTask" data-toggle="modal" data-target="#formModal" data-id="'.$data['tasks'][$usr]['id'].'">Ubah</a><a href="'. BASEURL .'/tasks/change/'.$data['tasks'][$usr]['id'].'" class="badge badge-success modalUploadTask" data-toggle="modal" data-target="#formModalUpload" data-id="'.$data['tasks'][$usr]['id'].'">Detail</a></td>'; ?>
                
                  <?php if ($_SESSION['user']['role_name'] === 'staff') echo '<td><a href="'. BASEURL .'/tasks/change/'.$data['tasks'][$usr]['id'].'" class="badge badge-success modalUploadTask" data-toggle="modal" data-target="#formModalUpload" data-id="'.$data['tasks'][$usr]['id'].'">Upload</td>'; ?>
                  <?php if ($_SESSION['user']['role_name'] === 'clients') echo '<td><a href="'. BASEURL .'/tasks/change/'.$data['tasks'][$usr]['id'].'" class="badge badge-success modalUploadTask" data-toggle="modal" data-target="#formModalUpload" data-id="'.$data['tasks'][$usr]['id'].'">Lihat</td>'; ?>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php else: ?>

          <div class="alert alert-danger " role="alert">
            Belum ada tugas
          </div>
        <?php endif ?>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Tambah Data Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= BASEURL; ?>/tasks/add" method="post" class="form1">
        <div class="modal-body">
          <input type="hidden" name="id" id="id" >
          <div class="form-group">
            <label for="name">Nama Task</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          
          <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea 
              class="form-control" 
              aria-label="With textarea" 
            name="description"
              col="4"  
              id="description"
            ></textarea>
          </div>

          <div class="form-group">
            <label for="tgl_deadline">Deadline</label>
            <input 
              class="form-control" 
              name="tgl_deadline" 
              type="date" 
              id="tgl_deadline" 
            />
          </div>

          <div class="form-group">
            <label for="staff">Staff</label>
            <select class="form-control" id="staff" name="staff"> 
              <?php foreach($data['staffs'] as $staff) : ?>
                <option value="<?= $staff['id'] ?>"><?= $staff['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="client">Client</label>
            <select class="form-control" id="client" name="client"> 
              <?php foreach($data['clients'] as $client) : ?>
                <option value="<?= $client['id'] ?>"><?= $client['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Tambah Data</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="formModalClientUpload" tabindex="-1" aria-labelledby="exampleModalUploadLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalUploadLabel">Detail Berkas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-info">
        <div class="row">
          <div class="col-md-6">
            <label class="font-weight-bold">Tugas</label>
            <p id="task_name">Tugas Pajak 1</p>
          </div>
          <div class="col-md-6">
            <label class="font-weight-bold">Tanggal Deadline</label>
            <p id="task_tgl" class="btn-sm btn-text btn-light-primary text-uppercase font-weight-bold">12 Septemper 2021</p>
          </div>
          <div class="col-md-12">
            <label class="font-weight-bold">Deskripsi</label>
            <p id="task_description">Tugas Pajak 1</p>
          </div>
          <div class="col-md-12">
            <label class="font-weight-bold">Files</label>
            <ul id="listDataBerkas" class="list-file">
            </ul>
          </div>
          <div class="col-md-12">
            <?php if ($_SESSION['user']['role_name'] === 'clients'):?>
              <form method="post" action="<?= BASEURL; ?>/tasks/changeToProcess" class="hiddenSiap">
                <input hidden name="id" id="idTas" >
                <input hidden name="proses" value="Siap diproses" >
                <button type="submit" class="btn btn-success">Siap diprocess</button>
              </form>
            <?php endif ?>
            <?php if ($_SESSION['user']['role_name'] !== 'clients'):?>
              <form method="post" action="<?= BASEURL; ?>/tasks/changeToProcess" class="hiddenSedang">
                <input hidden name="id" id="idTas" >
                <input hidden name="proses" value="Sedang diproses" >
                <button type="submit" class="btn btn-success">Sedang diprosess</button>
              </form>
            <?php endif ?>
          </div>
        </div>
      </div>
      <form action="<?= BASEURL; ?>/tasks/uploadBerkas" method="post" class="form2" enctype="multipart/form-data">
        <div class="modal-body">
          <input hidden name="id" id="idUpload" class="idTask">
          <?php if (($_SESSION['user']['role_name'] === 'clients')): ?>

            <div class="button-wrap">
              <label class="new-button" for="fileUpload"> Upload File</label>
              <input type="file" id="fileUpload" name="fileUpload">
            </div>
          <?php endif ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <?php if ($_SESSION['user']['role_name'] === 'clients'):?>
            <button type="submit" class="btn btn-primary">Save Data</button>
          <?php endif ?>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="formModalUpload" tabindex="-1" aria-labelledby="exampleModalUploadLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalUploadLabel">Detail Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-info">
        <div class="row">
          <div class="col-md-6">
            <label class="font-weight-bold">Tugas</label>
            <p id="task_name">Tugas Pajak 1</p>
          </div>
          <div class="col-md-6">
            <label class="font-weight-bold">Tanggal Deadline</label>
            <p id="task_tgl" class="btn-sm btn-text btn-light-primary text-uppercase font-weight-bold">12 Septemper 2021</p>
          </div>
          <div class="col-md-12">
            <label class="font-weight-bold">Deskripsi</label>
            <p id="task_description">Tugas Pajak 1</p>
          </div>
          <div class="col-md-12 mb-3">
            <label for="description">Feedback</label>
            <ul id="listDataFeedback" class="list-file">
            </ul>
            <?php if ($_SESSION['user']['role_name'] === 'clients'):?>
              <form action="<?= BASEURL; ?>/tasks/addNote" method="post" class="hiddenSelesai">
                <input type="hidden" name="id" id="idTask" >
                <div class="form-group">
                  
                  <textarea 
                    class="form-control" 
                    aria-label="With textarea" 
                    name="description"
                    col="4"  
                    id="description"
                  ></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Feedback</button>
              </form>
            <?php endif ?>
          </div>
          <div class="col-md-12 mb-3 hiddenSelesai">
            <?php if ($_SESSION['user']['role_name'] === 'clients'):?>
              <form method="post" action="<?= BASEURL; ?>/tasks/changeToProcess">
                <input hidden name="id" class="idTask" >
                <input hidden name="proses" value="Selesai" >
                <button type="submit" class="btn btn-success">Close Feedback</button>
              </form>
            <?php endif ?>
          </div>

          <div class="col-md-12">
            <label class="font-weight-bold">Files</label>
            <ul id="listData" class="list-file">
            </ul>
          </div>
          <div class="col-md-12">
            <?php if ($_SESSION['user']['role_name'] === 'konsultan'):?>
              <form method="post" action="<?= BASEURL; ?>/tasks/changeToProcess">
                <input hidden name="id" id="idTasks" >
                <input hidden name="proses" value="Siap dicek" >
                <button type="submit" class="btn btn-success">Siap dicek</button>
              </form>
            <?php endif ?>
          </div>
        </div>
      </div>
      <form action="<?= BASEURL; ?>/tasks/upload" method="post" class="form2" enctype="multipart/form-data">
        <div class="modal-body">
          <input hidden name="id" id="idUpload" class="idTask">
          <?php if (($_SESSION['user']['role_name'] !== 'clients')): ?>
            <div class="button-wrap">
              <label class="new-button" for="fileUpload1"> Upload File</label>
              <input type="file" id="fileUpload1" name="fileUpload1">
          </div>
          <?php endif ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <?php if (($_SESSION['user']['role_name'] !== 'clients')) echo '<button type="submit" class="btn btn-primary">Save Data</button>'; ?>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="formModalCetak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Cetak Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form 
        action="<?= BASEURL; ?>/tasks/export" 
        method="post" 
        class="form1"
        target="_blank"
      >
        <div class="modal-body">
          <div class="form-group">
            <label for="from_date">Dari</label>
            <input 
              class="form-control" 
              name="from_date" 
              type="date" 
              id="from_date" 
            />
          </div>
          <div class="form-group">
            <label for="from_date">Sampai</label>
            <input 
              class="form-control" 
              name="to_date" 
              type="date" 
              id="from_date" 
            />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <?php if (($_SESSION['user']['role_name'] !== 'clients')) echo '<button type="submit" class="btn btn-primary">Cetak</button>'; ?>
        </div>
      </form>
    </div>
  </div>
</div>