  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link <?php echo (uri_string() == '/admin') ? "" : "collapsed" ?>" href="/admin">
            <span>Dashboard</span>
        </a>
    </li><!-- End Home Nav -->

    <li class="nav-item">
        <a class="nav-link <?php echo (uri_string() == '/room') ? "" : "collapsed" ?>" href="/admin/room">
            <span>Rooms</span>
        </a>
    </li><!-- End Keranjang Nav --> 
    <li class="nav-item">
        <a class="nav-link <?php echo (uri_string() == '/booking') ? "" : "collapsed" ?>" href="/admin/booking">
            <span>Booking</span>
        </a>
    </li><!-- End Keranjang Nav --> 
    <li class="nav-item">
        <a class="nav-link <?php echo (uri_string() == '/gallery') ? "" : "collapsed" ?>" href="/admin/gallery">
            <span>Gallery</span>
        </a>
    </li><!-- End Keranjang Nav --> 
    <li class="nav-item">
        <a class="nav-link <?php echo (uri_string() == '/admin') ? "" : "collapsed" ?>" href="/admin/setting">
            <span>Setting</span>
        </a>
    </li><!-- End Keranjang Nav --> 
    <li class="nav-item">
        <a class="nav-link <?php echo (uri_string() == '/admin') ? "" : "collapsed" ?>" data-bs-toggle="modal" data-bs-target="#logoutModal" href="#">
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