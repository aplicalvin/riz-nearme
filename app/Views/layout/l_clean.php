<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- Judul -->
        <title><?= $judul ?? 'Judul Default' ?></title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7"
            crossorigin="anonymous"
        />
        <!-- Import Local CSS -->
        <link rel="stylesheet" href="<?= base_url('css/main.css') ?>">
        <!-- Import Favicon -->
        <link rel="icon" href="<?= base_url('assets/logo.png') ?>" type="image/x-icon">
        <link rel="icon" href="" type="image/x-icon">

        <!-- FONTAWESOME -->
        <link href="<?= base_url('assets/fontawesome/all.min.css') ?>" rel="stylesheet">
        
        <!-- BOOTSTRAP ICON -->
        <link href="<?= base_url('assets/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">

        <!-- ICON -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    </head>
    <body>
        <!-- ================ navbar ================ -->
         <?= $this->include('components/c_clean_navbar') ?>
        <!-- ================ navbar END ================ -->
         
        <!-- ================ KONTEN UTAMA ================ -->
        <main class="maincontent" style="min-height: 80vh; background-color: #E0F0FE;">
          <?php echo $this->renderSection("main_content") ?>
        </main>
        <!-- ================ KONTEN UTAMA END ================ -->

        <!-- ================ FOOTER ================ -->
         <?= $this->include('components/c_clean_footer.php') ?>
        <!-- ================ FOOTER END ================ -->

        <!-- External Bootstrap JavaScript -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
            crossorigin="anonymous"
        ></script>
        <!-- External Bootstrap JavaScript -->
    </body>
</html>
