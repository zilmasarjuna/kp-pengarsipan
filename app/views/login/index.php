<div class="login">
  <div class="content">
    <div class="card login-card">
      <form action="<?= BASEURL; ?>/login/auth" class="login-form" method="post">
        <h3>Sign in</h3>
        <?php Flasher::flashError(); ?>
        <div class="form-group">
          <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
          <label class="control-label visible-ie8 visible-ie9">Username</label>
          <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
        </div>
        <div class="form-group">
          <label class="control-label visible-ie8 visible-ie9">Password</label>
          <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-success uppercase">Login</button>
        </div>
      </form>
    </div>
  </div>
</div>