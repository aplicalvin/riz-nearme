<?php echo $this->extend("layout/layout_utama"); ?>
<?php echo $this->section("konten_utama") ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Detail Pemesanan #<?= $booking['id'] ?></h3>
                </div>
                <div class="card-body">
                    <!-- PESAN KONFIRMASI -->
                     <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
    
                    <?php if (session()->getFlashdata('failed')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('failed') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <!-- PESAN KONFIRMASI -->
                    <!-- Status Pemesanan -->
                    <div class="alert alert-<?= 
                        $booking['status'] == 'confirmed' ? 'success' : 
                        ($booking['status'] == 'cancelled' ? 'danger' : 'warning') 
                    ?>">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Status Pemesanan:</strong> 
                                <?= ucfirst($booking['status']) ?>
                            </div>
                            <div>
                                <strong>Status Pembayaran:</strong> 
                                <span class="badge bg-<?= 
                                    $booking['payment_status'] == 'paid' ? 'success' : 
                                    ($booking['payment_status'] == 'failed' ? 'danger' : 'warning') 
                                ?>">
                                    <?= ucfirst($booking['payment_status']) ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Informasi Hotel -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Informasi Hotel</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <img src="<?= !empty($booking['hotel_photo']) ? base_url('uploads/hotels/'.$booking['hotel_photo']) : 'https://source.unsplash.com/random/600x400/?hotel' ?>" 
                                            class="img-fluid rounded" alt="<?= esc($booking['hotel_name']) ?>">
                                    </div>
                                    <h4><?= esc($booking['hotel_name']) ?></h4>
                                    <p class="text-muted">
                                        <i class="fas fa-map-marker-alt"></i> <?= esc($booking['hotel_address']) ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Pemesanan -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Detail Pemesanan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <h6>Kamar yang Dipesan</h6>
                                        <div class="d-flex">
                                            <?php if (!empty($booking['room_photo'])): ?>
                                                <img src="<?= base_url('uploads/rooms/'.$booking['room_photo']) ?>" 
                                                    class="rounded me-3" width="100" height="80" style="object-fit: cover;" 
                                                    alt="<?= esc($booking['room_type_name']) ?>">
                                            <?php endif; ?>
                                            <div>
                                                <p class="mb-1"><?= esc($booking['room_type_name']) ?></p>
                                                <p class="text-muted mb-1"><?= number_to_currency($booking['room_price'], 'IDR') ?>/malam</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <h6>Tanggal Menginap</h6>
                                        <p>
                                            <?= date('d M Y', strtotime($booking['check_in_date'])) ?> - 
                                            <?= date('d M Y', strtotime($booking['check_out_date'])) ?>
                                            (<?= (new \DateTime($booking['check_out_date']))->diff(new \DateTime($booking['check_in_date']))->days ?> malam)
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <h6>Jumlah Tamu</h6>
                                        <p><?= $booking['adults'] ?> Dewasa, <?= $booking['children'] ?> Anak-anak</p>
                                    </div>

                                    <div class="mb-3">
                                        <h6>Metode Pembayaran</h6>
                                        <p><?= esc($booking['payment_method_name'] ?? 'Belum dipilih') ?></p>
                                    </div>

                                    <?php if (!empty($booking['special_requests'])): ?>
                                        <div class="mb-3">
                                            <h6>Permintaan Khusus</h6>
                                            <p><?= esc($booking['special_requests']) ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ringkasan Pembayaran -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Ringkasan Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><?= esc($booking['room_type_name']) ?> × <?= (new \DateTime($booking['check_out_date']))->diff(new \DateTime($booking['check_in_date']))->days ?> malam</td>
                                            <td class="text-end"><?= number_to_currency($booking['room_price'] * (new \DateTime($booking['check_out_date']))->diff(new \DateTime($booking['check_in_date']))->days, 'IDR') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Pajak & Layanan</td>
                                            <td class="text-end"><?= number_to_currency(0, 'IDR') ?></td>
                                        </tr>
                                        <tr class="fw-bold">
                                            <td>Total</td>
                                            <td class="text-end"><?= number_to_currency($booking['total_price'], 'IDR') ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <?php if ($booking['payment_status'] == 'pending' && $booking['status'] == 'pending'): ?>
                                <div class="mt-4">
                                    <h6>Upload Bukti Pembayaran</h6>
                                    <form action="<?= base_url('booking/upload/'.$booking['id']) ?>" method="post" enctype="multipart/form-data">
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control" name="payment_proof" required>
                                            <button class="btn btn-primary" type="submit">Upload</button>
                                        </div>
                                        <small class="text-muted">Format: JPG, PNG (maks. 2MB)</small>
                                    </form>
                                </div>
                            <?php elseif ($booking['payment_proof']): ?>
                                <div class="mt-4">
                                    <h6>Bukti Pembayaran</h6>
                                    <img src="<?= base_url('uploads/payments/'.$booking['payment_proof']) ?>" 
                                        class="img-thumbnail" style="max-height: 200px;" alt="Bukti Pembayaran">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('/user/bookings') ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Pemesanan
                        </a>
                        
                        <?php if ($booking['status'] == 'pending'): ?>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal">
                                Batalkan Pemesanan
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cancel Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Batalkan Pemesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin membatalkan pemesanan ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <form action="<?= base_url('booking/cancel/'.$booking['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger">Ya, Batalkan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>