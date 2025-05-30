<?php
$hlm = "Home";
if (uri_string() != "") {
  $hlm = ucwords(uri_string());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $hlm ?> - Toko</title>
  <meta name="description" content="Dashboard Admin Toko Online">
  <meta name="keywords" content="admin, toko, dashboard, ecommerce">

  <!-- ICON -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Favicons -->
  <link href="<?= base_url() ?>NiceAdmin/assets/img/favicon.png" rel="icon">
  <link href="<?= base_url() ?>NiceAdmin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url() ?>css/main.css" rel="stylesheet">
  <link href="<?= base_url() ?>NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url() ?>NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>NiceAdmin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?= base_url() ?>NiceAdmin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?= base_url() ?>NiceAdmin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url() ?>NiceAdmin/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="<?= base_url() ?>NiceAdmin/assets/css/style.css" rel="stylesheet">

  <!-- Template Info -->
  <!-- 
    Template Name: NiceAdmin
    Updated: Mar 09 2023 with Bootstrap v5.2.3
    Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  -->

  <!-- jQuery -->
  <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
</head>

<body>

  <?= $this->include('components/c_admin_header') ?>
  <?= $this->include('components/c_admin_sidebar') ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb bg-white p-3 rounded shadow-sm small mb-4">
          <li class="breadcrumb-item">
            <a href="<?= base_url() ?>/admin" class="text-decoration-none text-primary d-flex align-items-center gap-1">
              <i class="bi bi-house-door-fill"></i> Home
            </a>
          </li>
          <?php if ($hlm != "Home") : ?>
            <li class="breadcrumb-item active text-dark" aria-current="page">
              <?= $hlm ?>
            </li>
          <?php endif; ?>
        </ol>

      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card shadow-sm border-0">
            <div class="card-body p-4">
              <?= $this->renderSection('content') ?>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?= $this->include('components/c_admin_footer') ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center shadow"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url() ?>NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?= base_url() ?>NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>NiceAdmin/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="<?= base_url() ?>NiceAdmin/assets/vendor/echarts/echarts.min.js"></script>
  <script src="<?= base_url() ?>NiceAdmin/assets/vendor/quill/quill.min.js"></script>
  <script src="<?= base_url() ?>NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?= base_url() ?>NiceAdmin/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?= base_url() ?>NiceAdmin/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url() ?>NiceAdmin/assets/js/main.js"></script>

</body>

</html>
