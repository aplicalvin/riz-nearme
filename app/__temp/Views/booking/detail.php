<?= $this->extend('templates/header') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/bookings">Riwayat</a></li>
                <li class="breadcrumb-item active">Booking #<?= $booking['id'] ?></li>
            </ol>
        </nav>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-receipt"></i> Detail Pemesanan</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6>ID Booking</h6>
                        <p>#<?= $booking['id'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <h6>Status</h6>
                        <p>
                            <span class="badge bg-<?= 
                                $booking['status'] === 'confirmed' ? 'success' : 
                                ($booking['status'] === 'pending' ? 'warning' : 'danger') 
                            ?>">
                                <?= ucfirst($booking['status']) ?>
                            </span>
                        </p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6>Hotel</h6>
                        <p><?= esc($booking['hotel_name']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <h6>Tipe Kamar</h6>
                        <p><?= esc($booking['room_name']) ?></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6>Check-in</h6>
                        <p><?= date('l, d F Y', strtotime($booking['check_in_date'])) ?></p>
                    </div>
                    <div class="col-md-6">
                        <h6>Check-out</h6>
                        <p><?= date('l, d F Y', strtotime($booking['check_out_date'])) ?></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6>Total Pembayaran</h6>
                        <p class="fw-bold">Rp <?= number_format($booking['total_price'], 0, ',', '.') ?></p>
                    </div>
                    <div class="col-md-6">
                        <h6>Metode Pembayaran</h6>
                        <p><?= esc($booking['payment_method_name']) ?></p>
                    </div>
                </div>

                <?php if ($booking['status'] === 'pending'): ?>
                <div class="alert alert-warning">
                    <h6><i class="fas fa-info-circle"></i> Instruksi Pembayaran</h6>
                    <p>Silakan transfer ke Virtual Account: <strong><?= $booking['payment_reference'] ?></strong></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-hotel"></i> Info Hotel</h5>
            </div>
            <div class="card-body">
                <h6>Alamat</h6>
                <p class="mb-3"><?= esc($booking['hotel_address']) ?></p>
                <h6>Kontak</h6>
                <p><?= esc($booking['hotel_phone'] ?? 'Tidak tersedia') ?></p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>