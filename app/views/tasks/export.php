<html>
  <head>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/export.css" />

  </head>
  <body onload="window.print()">
    <div class="container">
      <div class="title-export">
        <h5>Laporan Task</h5>
        <p><?= date_format(date_create($data['post']['from_date']), 'd F Y') ?> - <?= date_format(date_create($data['post']['to_date']), 'd F Y') ?></p>
      </div>
      <?php if (count($data['tasks']) > 0):?>
        <table class="table display nowrap" id="example">
          <thead>
            <tr>
              <th>#</th>
              <th>Tugas</th>
              <?php if ($_SESSION['user']['role_name'] !== 'staff') echo '<th>Staff</th>' ?>
              <?php if ($_SESSION['user']['role_name'] !== 'clients') echo '<th>Client</th>' ?>
              <th>Deadline</th>
              <th>Dibuat</th>
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
                <td><?= $data['tasks'][$usr]['tgl_created']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>

        <div class="alert alert-danger " role="alert">
          Tidak ada data task
        </div>
      <?php endif ?>
    </div>
  </body>
</html>