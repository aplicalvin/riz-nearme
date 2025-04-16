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
    </head>
    <body>
        <!-- KONTEN UTAMA -->
        <?php echo $this->renderSection("konten_utama") ?>
        <!-- KONTEN UTAMA -->

        <!-- ADD FOOTER -->
         <?= $this->include('components/footer.php') ?>
        <!-- ADD FOOTER -->

        <!-- External Bootstrap JavaScript -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
            crossorigin="anonymous"
        ></script>
        <!-- External Bootstrap JavaScript -->
    </body>
</html>
