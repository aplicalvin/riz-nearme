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
        <a class="nav-link <?php echo (uri_string() == '/admin') ? "" : "collapsed" ?>" href="/admin/setting">
            <span>Setting</span>
        </a>
    </li><!-- End Keranjang Nav --> 
    <li class="nav-item">
        <a class="nav-link <?php echo (uri_string() == '/admin') ? "" : "collapsed" ?>" href="/logout">
            <span>Logout</span>
        </a>
    </li><!-- End Keranjang Nav --> 
    <?php 
      if (session()->get('role') == 'admin') {
    ?>
    <li class="nav-item">
        <a class="nav-link <?php echo (uri_string() == '/info') ? "" : "collapsed" ?>" href="produk">
            <span>Produk</span>
        </a>
    </li><!-- End Produk Nav --> 
</ul>

<?php 
};
?>
</aside><!-- End Sidebar-->