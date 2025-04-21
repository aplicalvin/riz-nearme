<?= $this->extend('templates/header') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center mt-5">
    <div class="col-md-6 text-center">
        <div class="card">
            <div class="card-body">
                <h1 class="display-1 text-primary">404</h1>
                <h2 class="mb-4">Halaman Tidak Ditemukan</h2>
                <p class="lead">Maaf, halaman yang Anda cari tidak ditemukan.</p>
                <a href="/" class="btn btn-primary mt-3">
                    <i class="fas fa-home"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>