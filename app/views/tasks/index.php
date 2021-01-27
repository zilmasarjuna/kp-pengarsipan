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
          <button type="button" class="btn btn-primary font-weight-bolder addModalTask" data-toggle="modal" data-target="#formModal">
            New Record
          </button>
        </div>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Task</th>
              <?php if ($_SESSION['user']['role_name'] !== 'staff') echo '<th>Staff</th>' ?>
              <?php if ($_SESSION['user']['role_name'] !== 'clients') echo '<th>Client</th>' ?>
              <th>Deadline</th>
              <th>Status</th>
              <?php if ($_SESSION['user']['role_name'] !== 'clients') echo '<th>Action</th>' ?>
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
                <td><?= $data['tasks'][$usr]['tgl_deadline']; ?></td>
                <?php if ($_SESSION['user']['role_name'] === 'konsultan') echo '<td><a href="'. BASEURL .'/tasks/delete/'. $data['tasks'][$usr]['id'] .'" class="badge badge-danger mr-1" onclick="return confirm("yakin?")">hapus</a>
                    <a href="'. BASEURL .'/tasks/change/'. $data['tasks'][$usr]['id'] .'" class="badge badge-warning mr-1 modalUbahTask" data-toggle="modal" data-target="#formModal" data-id="'.$data['tasks'][$usr]['id'].'">Ubah</a></td>'; ?>
              
                <?php if ($_SESSION['user']['role_name'] === 'staff') echo '<td><a href="'. BASEURL .'/tasks/change/'.$data['tasks'][$usr]['id'].'" class="badge badge-warning modalUploadTask" data-toggle="modal" data-target="#formModalUpload" data-id="'.$data['tasks'][$usr]['id'].'">Upload</td>'; ?>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
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
<div class="modal fade" id="formModalUpload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Detail Task</h5>
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
          <div className="col-md-6">
            <label class="font-weight-bold">Tanggal Deadline</label>
            <p id="task_tgl" class="btn-sm btn-text btn-light-primary text-uppercase font-weight-bold">12 Septemper 2021</p>
          </div>
          <div class="col-md-12">
            <label class="font-weight-bold">Deskripsi</label>
            <p id="task_description">Tugas Pajak 1</p>
          </div>
          <div class="col-md-12">
            <label class="font-weight-bold">Files</label>
            <ul id="listData" class="list-file">
              
            </ul>
          </div>
        </div>
      </div>
      <form action="<?= BASEURL; ?>/tasks/upload" method="post" class="form1" enctype="multipart/form-data">
        <div class="modal-body">
          <input hidden name="id" id="idUpload" >
          <div class="button-wrap">
            <label class="new-button" for="fileUpload"> Upload File</label>
            <input type="file" id="fileUpload" name="fileUpload">
          <div>
          <!-- <div class="fallback dz-message">
            <input type="file" id="fileUpload" name="fileUpload">
          </div> -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Data</button>
        </div>
      </form>
    </div>
  </div>
</div>