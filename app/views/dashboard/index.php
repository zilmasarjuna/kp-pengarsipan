<div class="dashboard">
  <div class="container mt-5">
    <div class="row">
      <?php if (($_SESSION['user']['role_name'] === 'konsultan')): ?>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <div class="card-title">
                <h5>User</h5>
              </div>
              <div class="card-toolbar">
                <a href="<?= BASEURL; ?>/user">Lihat selengkapnya</a>
              </div>
            </div>
            <div class="card-body">
              <?php if (count($data['user']) > 0): ?>
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Username</th>
                      <th>Role User</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data['user'] as $usr => $index) : ?>
                      <tr>
                        <td><?= $usr+1 ?></td>
                        <td><?= $data['user'][$usr]['username']; ?></td>
                        <td><span class="label"><?= $data['user'][$usr]['name']; ?></span</td>
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
      <?php endif ?>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <div class="card-title">
              <h5>Task</h5>
            </div>
            <div class="card-toolbar">
              <a href="<?= BASEURL; ?>/tasks">Lihat selengkapnya</a>
            </div>
          </div>
          <div class="card-body">
            <?php if (count($data['tasks']) > 0):?>
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Task</th>
                    <?php if ($_SESSION['user']['role_name'] !== 'staff') echo '<th>Staff</th>' ?>
                    <?php if ($_SESSION['user']['role_name'] !== 'clients') echo '<th>Client</th>' ?>
                    <th>Deadline</th>
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
  </div>
</div>