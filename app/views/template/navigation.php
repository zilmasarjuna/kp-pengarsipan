<div class="header-top">
  <div class="container">
    <div class="d-none d-lg-flex align-items-center mr-3 justify-content-between">
                <!--begin::Logo-->
      <!-- <a href="/metronic/demo7/index.html" class="mr-20">
        <img alt="Logo" src="/metronic/theme/html/demo7/dist/assets/media/logos/logo-letter-9.png" class="max-h-35px">
      </a> -->
      <!--end::Logo-->
      <!--begin::Tab Navs(for desktop mode)-->
      <?php Menu::ShowMenu(); ?>
      <!--begin::Tab Navs-->
      <div class="topbar-item d-lg-flex align-items-center btn btn-icon btn-hover-transparent-white w-sm-auto d-flex align-items-center">
        <div class="btn-hover d-flex flex-column text-right">
          <span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-sm-inline"><?php Utils::GetUserName(); ?></span>
          <span class="text-white font-weight-bolder font-size-sm d-none d-sm-inline"><?php Utils::GetRoleName(); ?></span>
        </div>
      </div>
    </div>
    
  </div>
</div>