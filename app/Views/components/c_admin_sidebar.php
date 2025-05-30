  <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar bg-light shadow-sm">

<ul class="sidebar-nav nav flex-column" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center <?php echo (uri_string() == '/admin') ? "" : "collapsed" ?>" href="/admin">
            <i class="fas fa-tachometer-alt me-2 text-primary"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center <?php echo (uri_string() == '/room') ? "" : "collapsed" ?>" href="/admin/room">
            <i class="fas fa-door-open me-2 text-success"></i>
            <span>Rooms</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center <?php echo (uri_string() == '/booking') ? "" : "collapsed" ?>" href="/admin/booking">
            <i class="fas fa-calendar-check me-2 text-warning"></i>
            <span>Booking</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center <?php echo (uri_string() == '/gallery') ? "" : "collapsed" ?>" href="/admin/gallery">
            <i class="fas fa-images me-2 text-info"></i>
            <span>Gallery</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center <?php echo (uri_string() == '/setting') ? "" : "collapsed" ?>" href="/admin/setting">
            <i class="fas fa-cogs me-2 text-secondary"></i>
            <span>Setting</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center text-danger collapsed" data-bs-toggle="modal" data-bs-target="#logoutModal" href="#">
            <i class="fas fa-sign-out-alt me-2"></i>
            <span>Logout</span>
        </a>
    </li>
    
</ul>
</aside>








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