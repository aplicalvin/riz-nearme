  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link collapsed" href="/super">
            <span>Dashboard</span>
        </a>
    </li><!-- End Home Nav -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="/super/hotel">
            <span>Manajemen Hotel</span>
        </a>
    </li><!-- End Home Nav -->

    
     <li class="nav-item">
        <a class="nav-link collapsed" data-bs-toggle="modal" data-bs-target="#logoutModal" href="#">
            <span class="text-danger">Logout</span>
        </a>
    </li><!-- End Logout Nav -->
</ul>
</aside><!-- End Sidebar-->







<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true" >
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin keluar dari sistem?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="/logout" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
</div>