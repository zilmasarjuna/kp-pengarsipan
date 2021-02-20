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
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Users</h5>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <div class="card-title">
          <h5>User Management</h5>
        </div>
        <div class="card-toolbar">
          <button type="button" class="btn btn-primary font-weight-bolder addModal" data-toggle="modal" data-target="#formModal">
            New Record
          </button>
        </div>
      </div>
      <div class="card-body">
        <?php if (count($data['user']) > 0): ?>
          <table class="table display nowrap" id="example">
            <thead>
              <tr>
                <th>#</th>
                <th>Username</th>
                <th>Role User</th>
                <th>Action</th>      
              </tr>
            </thead>
            <tbody>
              <?php foreach($data['user'] as $usr => $index) : ?>
                <tr>
                  <td><?= $usr+1 ?></td>
                  <td><?= $data['user'][$usr]['username']; ?></td>
                  <td><?= $data['user'][$usr]['name']; ?></td>
                  <td>
                    <a href="<?= BASEURL; ?>/user/delete/<?= $data['user'][$usr]['id']; ?>" class="badge badge-danger mr-1" onclick="return confirm('yakin?')">hapus</a>
                    <a href="<?= BASEURL; ?>/user/change/<?= $data['user'][$usr]['id']; ?>" class="badge badge-warning mr-1 modalUbahUser" data-toggle="modal" data-target="#formModal" data-id="<?= $data['user'][$usr]['id']; ?>">Ubah</a>
                  </button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php else: ?>
          <div class="alert alert-danger " role="alert">
            Belum ada user
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
        <h5 class="modal-title" id="formModalLabel">Tambah Data User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= BASEURL; ?>/user/add" method="post" class="form1">
        <div class="modal-body">
          <input type="hidden" name="id" id="id" >
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username">
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>

          <div class="form-group hidden">
            <label for="fullname">Nama Staff/Perusahaan</label>
            <input type="text" class="form-control" id="fullname" name="fullname">
          </div>

          <div class="form-group hidden">
            <label for="no_telp">No Handphone</label>
            <input type="text" class="form-control" id="no_telp" name="no_telp">
          </div>

          <div class="form-group hidden">
            <label for="address">Alamat</label>
            <textarea 
              class="form-control" 
              aria-label="With textarea" 
            name="address"
              col="4"  
              id="address"
            ></textarea>
          </div>

          <div class="form-group hidden">
            <label for="role_id">Role</label>
            <select class="form-control" id="role_id" name="role_id"> 
              <option value="2">Staffs</option>
              <option value="3">Clients</option>
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
