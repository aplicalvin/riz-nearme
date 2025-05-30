<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center px-5 py-3" style="background-color: #e3f2fd; border-bottom: 1px solid #ccc; color: #333;">

  <div class="d-flex align-items-center justify-content-between">
    <a href="/" class="logo d-flex align-items-center text-dark">
      <i class="bi bi-stars me-2 fs-4 text-primary"></i>
      <span class="d-none d-lg-block fw-bold fs-5">NearMe <span class="text-primary">Super</span></span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn text-dark ms-3"></i>
  </div><!-- End Logo -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center gap-3 mb-0">

      <div class="nav-profile d-flex align-items-center gap-3">
        <img src="<?= base_url()?>NiceAdmin/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle" width="40">
        <span class="d-none d-md-block fw-semibold text-dark"><?= session()->get('username'); ?> <small class="text-muted fst-italic">(<?= session()->get('role'); ?>)</small></span>
      </div>

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
