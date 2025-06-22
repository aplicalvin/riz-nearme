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
                                        <!-- <tr>
                                            <td>Pajak & Layanan</td>
                                            <td class="text-end"><?= number_to_currency(0, 'IDR') ?></td>
                                        </tr> -->
                                        <tr class="fw-bold">
                                            <td>Total</td>
                                            <td class="text-end"><?= number_to_currency($booking['total_price'], 'IDR') ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- <?php //if ($booking['payment_status'] == 'pending' && $booking['status'] == 'pending'): ?>
                                <div class="mt-4">
                                    <h6>Upload Bukti Pembayaran</h6>
                                    <form action="< ? = //base_url('booking/upload/'.$booking['id']) ? >" method="post" enctype="multipart/form-data">
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control" name="payment_proof" required>
                                            <button class="btn btn-primary" type="submit">Upload</button>
                                        </div>
                                        <small class="text-muted">Format: JPG, PNG (maks. 2MB)</small>
                                    </form>
                                </div>
                            < ?php //elseif ($booking['payment_proof']): ?>
                                <div class="mt-4">
                                    <h6>Bukti Pembayaran</h6>
                                    <img src="< ?= //base_url('uploads/payments/'.$booking['payment_proof']) ?>" 
                                        class="img-thumbnail" style="max-height: 200px;" alt="Bukti Pembayaran">
                                </div>
                            < ?php //endif; ?> -->
                        </div>
                    </div>

                    <!-- REVIEW -->
                    <?php if ($booking['status'] == 'completed') : ?>

                    <div class="card mb-4">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Ulasan Anda</h5>
                        </div>
                        <div class="card-body">

                            <?php if (!empty($review)) : ?>
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <small class="text-muted"><?= date('d F Y', strtotime($review['created_at'])) ?></small>
                                        <div class="my-2">
                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <i class="bi bi-star<?= ($i <= $review['rating']) ? '-fill' : '' ?> text-warning"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#reviewModal" 
                                                    data-action="edit" 
                                                    data-review-id="<?= $review['id'] ?>"
                                                    data-rating="<?= $review['rating'] ?>"
                                                    data-comment="<?= esc($review['comment']) ?>">
                                                    <i class="bi bi-pencil-square me-2"></i>Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item text-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteReviewModal" 
                                                    data-review-id="<?= $review['id'] ?>">
                                                    <i class="bi bi-trash3-fill me-2"></i>Hapus
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="card-text mt-2"><?= nl2br(esc($review['comment'])) ?></p>

                            <?php else : ?>
                                <div class="text-center py-3">
                                    <p class="text-muted">Bagikan pengalaman menginap Anda.</p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal" data-action="add">
                                        <i class="bi bi-pencil-square me-2"></i> Tulis Ulasan
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="reviewModalLabel">Tulis Ulasan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form id="reviewForm" action="" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                                    <input type="hidden" name="hotel_id" value="<?= $booking['hotel_id'] ?>">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Rating Anda</label>
                                            <div class="star-rating">
                                                <input type="radio" id="5-stars" name="rating" value="5" required /><label for="5-stars" class="bi bi-star"></label>
                                                <input type="radio" id="4-stars" name="rating" value="4" /><label for="4-stars" class="bi bi-star"></label>
                                                <input type="radio" id="3-stars" name="rating" value="3" /><label for="3-stars" class="bi bi-star"></label>
                                                <input type="radio" id="2-stars" name="rating" value="2" /><label for="2-stars" class="bi bi-star"></label>
                                                <input type="radio" id="1-star" name="rating" value="1" /><label for="1-star" class="bi bi-star"></label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="comment" class="form-label">Komentar</label>
                                            <textarea class="form-control" id="comment" name="comment" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteReviewModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menghapus ulasan ini secara permanen?</p>
                                </div>
                                <div class="modal-footer">
                                    <form id="deleteReviewForm" action="" method="post">
                                        <?= csrf_field() ?>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <style>
                    .star-rating{display:flex;flex-direction:row-reverse;justify-content:flex-end;font-size:1.8rem}.star-rating input{display:none}.star-rating label{color:#ccc;cursor:pointer;transition:color .2s}.star-rating input:checked~label,.star-rating label:hover,.star-rating label:hover~label{color:#ffc107}
                    </style>

                    <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const reviewModal = document.getElementById('reviewModal');
                        if (reviewModal) {
                            reviewModal.addEventListener('show.bs.modal', function (event) {
                                const button = event.relatedTarget;
                                const action = button.getAttribute('data-action');
                                const form = document.getElementById('reviewForm');
                                const modalTitle = reviewModal.querySelector('.modal-title');

                                if (action === 'edit') {
                                    const reviewId = button.getAttribute('data-review-id');
                                    const rating = button.getAttribute('data-rating');
                                    const comment = button.getAttribute('data-comment');

                                    modalTitle.textContent = 'Edit Ulasan';
                                    form.action = '<?= base_url('reviews/update/') ?>' + reviewId;
                                    form.querySelector('#comment').value = comment;
                                    
                                    const starInput = form.querySelector('input[name="rating"][value="' + rating + '"]');
                                    if(starInput) starInput.checked = true;

                                } else { // action 'add'
                                    modalTitle.textContent = 'Tulis Ulasan';
                                    form.action = '<?= base_url('reviews/create') ?>';
                                    form.reset();
                                }
                            });
                        }

                        const deleteModal = document.getElementById('deleteReviewModal');
                        if(deleteModal){
                            deleteModal.addEventListener('show.bs.modal', function (event) {
                                const button = event.relatedTarget;
                                const reviewId = button.getAttribute('data-review-id');
                                const form = document.getElementById('deleteReviewForm');
                                form.action = '<?= base_url('reviews/delete/') ?>' + reviewId;
                            });
                        }
                    });
                    </script>
                    <?php endif; ?>
                    <!-- REVIEW -->

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