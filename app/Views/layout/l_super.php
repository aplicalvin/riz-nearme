<?php
$hlm = "Home";
if(uri_string()!=""){
  $hlm = ucwords(uri_string());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Super Admin - <?= $hlm ?></title>

  <link href="<?= base_url()?>NiceAdmin/assets/img/favicon.png" rel="icon">
  <link href="<?= base_url()?>NiceAdmin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  <link href="<?= base_url()?>NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url()?>NiceAdmin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?= base_url()?>NiceAdmin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <link href="<?= base_url()?>NiceAdmin/assets/css/style.css" rel="stylesheet">

  <style>
    :root {
      --warna-utama: #e3f2fd;
      --aksen-tombol-ikon: #2196f3;
      --teks-utama: #333;
      --background-sidebar: #ffffff;
      --aksen-hover: #1976d2; /* Slightly darker blue for hover */
      --border-color-soft: #dee2e6; /* Soft border color */
    }

    body {
      background-color: var(--warna-utama); /* Warna utama */
      font-family: 'Nunito', sans-serif;
      color: var(--teks-utama); /* Teks utama */
    }

    /* Sidebar Styling */
    /* NiceAdmin sidebar usually uses #sidebar or .sidebar class */
    #sidebar, .sidebar {
      background-color: var(--background-sidebar); /* Background sidebar */
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Bayangan lembut */
    }

    /* Card Styling */
    .card {
      background-color: var(--background-sidebar); /* Using sidebar background for cards for consistency */
      border: 1px solid var(--border-color-soft);
      color: var(--teks-utama);
      box-shadow: 0 1px 3px rgba(0,0,0,0.05); /* Bayangan lebih lembut untuk card */
    }

    .card-title {
      color: var(--teks-utama);
      font-weight: 600;
    }
    .card .card-title { /* More specific selector for card titles within cards */
        color: var(--teks-utama);
    }


    /* Page Title Styling */
    .pagetitle h1 {
      color: var(--teks-utama);
      font-weight: 700;
    }

    /* Breadcrumb Styling */
    .breadcrumb {
      background: transparent;
      font-size: 0.9rem; /* Slightly smaller for modern look */
    }

    .breadcrumb-item a {
      color: var(--aksen-tombol-ikon);
      text-decoration: none;
    }
    .breadcrumb-item a:hover {
      color: var(--aksen-hover);
    }

    .breadcrumb-item.active {
      color: #6c757d; /* Bootstrap's default muted color */
    }

    /* Main Content Area */
    #main {
      padding: 20px; /* Default NiceAdmin main padding */
      background-color: var(--warna-utama); /* Ensure main content bg */
    }

    /* Back to Top Button */
    .back-to-top {
      background-color: var(--aksen-tombol-ikon);
    }
    .back-to-top i {
      color: #ffffff; /* White icon for contrast */
    }
    .back-to-top:hover {
      background-color: var(--aksen-hover);
    }


    /* Button Styling (Overriding Bootstrap primary buttons) */
    .btn-primary {
      background-color: var(--aksen-tombol-ikon) !important;
      border-color: var(--aksen-tombol-ikon) !important;
      color: #ffffff !important;
    }
    .btn-primary:hover {
      background-color: var(--aksen-hover) !important;
      border-color: var(--aksen-hover) !important;
    }
    
    /* General Link Styling */
    a:not(.btn):not(.breadcrumb-item a):not(.nav-link):not(.dropdown-item) { /* Be more specific to avoid unwanted overrides */
        color: var(--aksen-tombol-ikon);
    }
    a:not(.btn):not(.breadcrumb-item a):not(.nav-link):not(.dropdown-item):hover {
        color: var(--aksen-hover);
    }

    /* NiceAdmin Header Adjustments */
    .header {
      background-color: var(--background-sidebar); /* White header */
      box-shadow: 0 2px 5px rgba(0,0,0,0.05); /* Soft shadow for header */
    }
    .header .toggle-sidebar-btn { /* Hamburger menu icon */
      color: var(--aksen-tombol-ikon);
    }
    .header .toggle-sidebar-btn:hover {
      color: var(--aksen-hover);
    }
    .header .search-bar {
        background: #f8f9fa;
    }
    .header .search-form button {
        background: var(--aksen-tombol-ikon);
        border:0; /* Remove border */
    }
    .header .search-form button:hover {
        background: var(--aksen-hover);
    }
    .header .search-form input {
        border-color: var(--border-color-soft);
    }
    .header .logo span { /* NiceAdmin Logo text */
        color: var(--teks-utama);
    }
    /* Header Nav Items (Profile, notifications, etc.) */
    .header .nav-link {
        color: var(--teks-utama); /* Dark text for header icons */
    }
    .header .nav-link:hover, .header .nav-link:focus {
        color: var(--aksen-tombol-ikon);
    }
     .header .nav-profile strong { /* Profile name */
        color: var(--teks-utama);
    }


    /* NiceAdmin Sidebar Link Adjustments */
    #sidebar .nav-link, .sidebar .nav-link {
      color: #555; /* Slightly muted text for sidebar links */
      background: transparent;
    }
    #sidebar .nav-link:hover, .sidebar .nav-link:hover {
      color: var(--aksen-tombol-ikon);
      background-color: rgba(33, 150, 243, 0.08); /* Very light accent bg on hover */
    }
    #sidebar .nav-link i, .sidebar .nav-link i { /* Sidebar icons */
      color: #777; /* Muted icon color */
    }
    #sidebar .nav-link:hover i, .sidebar .nav-link:hover i {
      color: var(--aksen-tombol-ikon);
    }

    #sidebar .nav-item.active > .nav-link, /* Incorrect NiceAdmin selector */
    #sidebar .nav-link.active, .sidebar .nav-link.active { /* Correct for active link */
      color: var(--aksen-tombol-ikon);
      background-color: rgba(33, 150, 243, 0.1); /* Light accent background for active item */
    }
    #sidebar .nav-link.active i, .sidebar .nav-link.active i {
      color: var(--aksen-tombol-ikon);
    }
    
    /* Sidebar Nav Heading (e.g., "PAGES") */
    .sidebar-nav .nav-heading {
        color: #999; /* Muted color for headings */
        font-weight: 600;
    }

    /* Footer Styling */
    .footer {
      background-color: #f8f9fa; /* Light grey for footer */
      color: var(--teks-utama);
      padding: 15px 0;
      border-top: 1px solid var(--border-color-soft);
      box-shadow: none; /* Remove default shadow if any or set to 0 -1px 3px rgba(0,0,0,0.05) for top shadow */
    }
    .footer a {
      color: var(--aksen-tombol-ikon);
    }
    .footer a:hover {
      color: var(--aksen-hover);
    }

    /* Ensure table header has good contrast */
    .table thead th {
        background-color: #f8f9fa; /* Light background for table headers */
        color: var(--teks-utama);
        border-bottom-width: 2px;
    }
    .table td, .table th {
        border-color: var(--border-color-soft); /* Soft borders for table cells */
    }

  </style>
</head>

<body>

  <?= $this->include('components/c_super_header') ?>
  <?= $this->include('components/c_super_sidebar') ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Super Admin</h1>
      <nav>
        <ol class="breadcrumb">
          <?php if ($hlm != "Home"): ?>
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active"><?= $hlm ?></li>
          <?php else: ?>
            <li class="breadcrumb-item active">Dashboard</li>
          <?php endif; ?>
        </ol>
      </nav>
    </div><section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card"> <div class="card-body">
              <h5 class="card-title"><?= $hlm ?></h5>
              <?= $this->renderSection('content') ?>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><?= $this->include('components/c_admin_footer') ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i> </a>

  <script src="<?= base_url()?>NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url()?>NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?= base_url()?>NiceAdmin/assets/vendor/quill/quill.min.js"></script> <script src="<?= base_url()?>NiceAdmin/assets/js/main.js"></script>

</body>
</html>