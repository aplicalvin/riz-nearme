  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center px-5 py-4">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block font-heading">NearMe Super</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
          <div class="nav-link nav-profile d-flex align-items-center gap-2">
            <span class="d-none d-md-block  ps-2"><?= session()->get('username'); ?> ( <?= session()->get('role'); ?>)</span>
            <img src="<?= base_url()?>NiceAdmin/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
          </div><!-- End Profile Iamge Icon -->

        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->