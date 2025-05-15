  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link <?php echo (uri_string() == '/admin') ? "" : "collapsed" ?>" href="/admin">
            <span>Dashboard</span>
        </a>
    </li><!-- End Home Nav -->

    
    <li class="nav-item">
        <a class="nav-link <?php echo (uri_string() == '/admin') ? "" : "collapsed" ?>" href="/logout">
            <span>Logout</span>
        </a>
    </li><!-- End Keranjang Nav --> 
    <?php 
      if (session()->get('role') == 'admin') {
    ?>
</ul>

<?php 
};
?>
</aside><!-- End Sidebar-->