<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center justify-content-between px-4 py-3 shadow-sm bg-white">

  <!-- Logo & Sidebar Toggle -->
  <div class="d-flex align-items-center">
    <a href="/admin" class="logo d-flex align-items-center text-decoration-none">
      <i class="bi bi-geo-alt-fill fs-4 me-2 text-primary"></i>
      <span class="fs-5 fw-bold d-none d-lg-block text-dark font-heading">NearMe Admin</span>
    </a>
    <button class="btn btn-sm btn-light ms-3 d-lg-none toggle-sidebar-btn">
      <i class="bi bi-list fs-5"></i>
    </button>
  </div>
  <!-- End Logo -->

  <!-- Profile Info -->
  <nav class="header-nav">
    <ul class="d-flex align-items-center list-unstyled mb-0">
      <li class="nav-item d-flex align-items-center gap-3">
        <span class="d-none d-md-block text-dark">
          <?= session()->get('username'); ?> (<?= session()->get('role'); ?>)
        </span>
        <img src="<?= view_cell('\App\Cells\UserCell::photo') ?>" alt="Profile" class="rounded-circle" width="36" height="36" style="object-fit: cover;">
      </li>
    </ul>
  </nav>
  <!-- End Profile -->

</header>
<!-- End Header -->
