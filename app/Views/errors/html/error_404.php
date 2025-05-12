<?= $this->extend('layout/l_clean') ?>

<?= $this->section('main_content') ?>
<div class="container text-center py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <img src="<?= base_url() ?>/assets/images/404.png" style="max-width: 30vw;" alt="">
            <i class="fas fa-exclamation-triangle text-warning display-1 mb-4"></i>
            <h1 class="mb-3 font-heading">404 - Tidak ditemukan</h1>
            <p class="lead mb-4">
                Halaman yang anda cari tidak ada, anda bisa kembali 
            </p>
            <a href="<?= base_url() ?>" class="btn btn-primary px-4">
                <i class="fas fa-home me-2"></i> Kembali
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>