<?php echo $this->extend("layout/l_super"); ?>
<?php echo $this->section("content"); ?>
<div class="container">
   <h3 class="font-heading">Welcome! <span class="fw-bold"><?= session()->get('full_name') ?> </span></h3>
   <h6>Pengelola hotel <span class="fw-bold">Grand Panorama</span></h6>
   <p>Anda login sebagai: <span class="badge bg-primary"><?= session()->get('role') ?></span></p>
</div>

<hr>
<!-- Statistik -->
<div class="container">
    <h2 class="font-heading mb-4">Statistik Sistem</h2>
    
    <div class="row">
        <!-- Card Jumlah Hotel -->
        <div class="col-md-3 mb-4">
            <div class="card border-primary h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary">Total Hotel</h5>
                    <h2 class="card-text fw-bold"><?= number_format($stat['jmlHotel']) ?></h2>
                    <p class="text-muted small">Hotel terdaftar</p>
                </div>
                <div class="card-footer bg-transparent border-primary">
                    <a href="<?= base_url('super/hotel') ?>" class="btn btn-sm btn-outline-primary">Lihat Data</a>
                </div>
            </div>
        </div>

        <!-- Card User Biasa -->
        <div class="col-md-3 mb-4">
            <div class="card border-success h-100">
                <div class="card-body">
                    <h5 class="card-title text-success">User Biasa</h5>
                    <h2 class="card-text fw-bold"><?= number_format($stat['jmluser']) ?></h2>
                    <p class="text-muted small">Pengguna terdaftar</p>
                </div>
                <div class="card-footer bg-transparent border-success">
                    <a href="#" class="btn btn-sm btn-outline-success">Lihat Data</a>
                </div>
            </div>
        </div>

        <!-- Card User Hotel -->
        <div class="col-md-3 mb-4">
            <div class="card border-warning h-100">
                <div class="card-body">
                    <h5 class="card-title text-warning">User Hotel</h5>
                    <h2 class="card-text fw-bold"><?= number_format($stat['jmlhotel']) ?></h2>
                    <p class="text-muted small">Admin hotel</p>
                </div>
                <div class="card-footer bg-transparent border-warning">
                    <a href="#" class="btn btn-sm btn-outline-warning">Lihat Data</a>
                </div>
            </div>
        </div>

        <!-- Card Super Admin -->
        <div class="col-md-3 mb-4">
            <div class="card border-danger h-100">
                <div class="card-body">
                    <h5 class="card-title text-danger">Super Admin</h5>
                    <h2 class="card-text fw-bold"><?= number_format($stat['jmlsuper']) ?></h2>
                    <p class="text-muted small">Administrator sistem</p>
                </div>
                <div class="card-footer bg-transparent border-danger">
                    <a href="#" class="btn btn-sm btn-outline-danger">Lihat Data</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Statistik -->
<?php echo $this->endSection() ?>