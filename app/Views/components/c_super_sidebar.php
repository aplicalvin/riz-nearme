<!-- CSS -->
 <!-- style -->
<!-- CSS -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar shadow-sm" style="background-color: #ffffff; color: #333; border-right: 1px solid #e0e0e0;">

  <ul class="sidebar-nav p-3" id="sidebar-nav">

    <li class="nav-item mb-2">
      <a class="nav-link d-flex align-items-center gap-2 text-dark" href="/super">
        <i class="bi bi-speedometer2 text-primary"></i><span>Dashboard</span>
      </a>
    </li>

    <li class="nav-item mb-2">
      <a class="nav-link d-flex align-items-center gap-2 text-dark" href="/super/hotel">
        <i class="bi bi-building text-primary"></i><span>Manajemen Hotel</span>
      </a>
    </li>

    <li class="nav-item mb-2">
      <a class="nav-link d-flex align-items-center gap-2 text-dark" href="/super/users">
        <i class="bi bi-people text-primary"></i><span>Manajemen User</span>
      </a>
    </li>

    <li class="nav-item mb-2">
      <a class="nav-link d-flex align-items-center gap-2 text-dark" href="/super/cities">
        <i class="bi bi-geo-alt text-primary"></i><span>Manajemen Kota</span>
      </a>
    </li>

    <li class="nav-item mt-4">
      <a class="nav-link d-flex align-items-center gap-2 text-danger" data-bs-toggle="modal" data-bs-target="#logoutModal" href="#">
        <i class="bi bi-box-arrow-right"></i><span class="fw-bold">Logout</span>
      </a>
    </li>

  </ul>
</aside><!-- End Sidebar -->

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-dark">
        Apakah Anda yakin ingin keluar dari sistem?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="/logout" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
</div>


