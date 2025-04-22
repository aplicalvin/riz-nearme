<?php echo $this->extend("layout/layout_utama"); ?>
<?php echo $this->section("konten_utama") ?>

<div class="container py-5">
    <!-- Header Hotel -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="font-heading"><?= esc($hotel['name']) ?></h1>
            <div class="d-flex align-items-center mb-2">
                <div class="me-3" style="color: #FFD700;">
                    <?= str_repeat('★', (int)$hotel['star_rating']) ?><?= str_repeat('☆', 5 - (int)$hotel['star_rating']) ?>
                </div>
                <span class="badge text-dark me-2" style="background-color: #075085;"><?= number_format($avg_rating, 1) ?> / 5</span>
                <span class="text-muted">(<?= $total_reviews ?> ulasan)</span>
            </div>
            <div class="d-flex align-items-center text-muted mb-3">
                <i class="fas fa-map-marker-alt me-2"></i>
                <?= esc($hotel['address']) ?>
                <?php if (!empty($hotel['city_name'])): ?>
                    , <?= esc($hotel['city_name']) ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="#booking-form" class="btn btn-lg btn-primary" style="background-color: #0176C8; border-color: #0176C8;">
                <i class="fas fa-calendar-alt me-2"></i>Pesan Sekarang
            </a>
            
        </div>
    </div>

    <!-- ======== Galeri Hotel======== -->
    <!-- Galeri Hotel - Hanya Tampilkan 1 Foto Utama -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="main-image" style="height: 400px; background-image: url('<?= !empty($hotel['cover_photo']) ? base_url('uploads/hotels/'.$hotel['cover_photo']) : 'https://source.unsplash.com/random/800x600/?hotel' ?>'); background-size: cover; background-position: center; border-radius: 8px; position: relative;">
            
                
            </div>
        </div>
    </div>

    <!-- ======== Info Hotel  ========-->
    <div class="row">
        <div class="col-lg-8">
            <!-- Deskripsi -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="font-heading mb-4">Tentang Hotel Ini</h3>
                    <p><?= !empty($hotel['description']) ? nl2br(esc($hotel['description'])) : 'Hotel ini menawarkan akomodasi dengan layanan dan fasilitas yang lengkap.' ?></p>
                </div>
            </div>

            <!-- ======== Fasilitas ======== -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="font-heading mb-4">Fasilitas & Layanan</h3>
                    <div class="row">
                        <?php if (!empty($facilities)): ?>
                            <?php foreach ($facilities as $facility): ?>
                            <div class="col-md-4 mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span><?= esc($facility['name']) ?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12">
                                <p class="text-muted">Informasi fasilitas belum tersedia</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Tipe Kamar -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="font-heading mb-4">Tipe Kamar</h3>
                    <?php if (!empty($room_types)): ?>
                        <?php foreach ($room_types as $room): ?>
                        <div class="mb-4 pb-4 border-bottom">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="<?= !empty($room['photo']) ? base_url('uploads/rooms/'.$room['photo']) : 'https://source.unsplash.com/random/300x200/?hotel-room' ?>" class="img-fluid rounded" alt="<?= esc($room['name']) ?>">
                                </div>
                                <div class="col-md-8">
                                    <h4><?= esc($room['name']) ?></h4>
                                    <p><?= esc($room['description']) ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="fw-bold"><?= number_to_currency($room['base_price'], 'IDR') ?></span>
                                            <span class="text-muted">/malam</span>
                                        </div>
                                        <a href="#booking-form" class="btn btn-sm btn-primary">Pesan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">Informasi kamar belum tersedia</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Ulasan -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="font-heading mb-4">Ulasan Tamu</h3>
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-4 text-center">
                            <h2 class="mb-0"><?= number_format($avg_rating, 1) ?></h2>
                            <div class="text-warning">
                                <?= str_repeat('★', round($avg_rating)) ?>
                            </div>
                            <small class="text-muted"><?= $total_reviews ?> ulasan</small>
                        </div>
                        <div class="flex-grow-1">
                            <?php foreach ([5,4,3,2,1] as $stars): ?>
                            <div class="d-flex align-items-center mb-2">
                                <small class="me-2"><?= $stars ?> bintang</small>
                                <div class="progress flex-grow-1" style="height: 8px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $rating_percent['rating_'.$stars] ?>%;" aria-valuenow="<?= $rating_percent['rating_'.$stars] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="ms-2 text-muted"><?= $rating_percent['rating_'.$stars] ?>%</small>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <?php if (!empty($reviews)): ?>
                        <?php foreach ($reviews as $review): ?>
                        <div class="review mb-4 pb-4 border-bottom">
                            <div class="d-flex align-items-center mb-3">
                                <img src="<?= !empty($review['photo']) ? base_url('uploads/users/'.$review['photo']) : base_url('assets/images/default-user.jpg') ?>" class="rounded-circle me-3" width="50" height="50" alt="<?= esc($review['full_name']) ?>">
                                <div>
                                    <h5 class="mb-0"><?= esc($review['full_name']) ?></h5>
                                    <small class="text-muted"><?= date('d M Y', strtotime($review['created_at'])) ?></small>
                                </div>
                            </div>
                            <div class="text-warning mb-2">
                                <?= str_repeat('★', $review['rating']) ?><?= str_repeat('☆', 5 - $review['rating']) ?>
                            </div>
                            <p><?= esc($review['comment']) ?></p>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">Belum ada ulasan untuk hotel ini</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Sidebar Pemesanan -->
        <div class="col-lg-4">
            <div id="booking-form" class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                <div class="card-body">
                    <h3 class="font-heading mb-4">Cek Ketersediaan</h3>
                    <form action="<?= base_url('/booking/create') ?>" method="post">
                        <input type="hidden" name="hotel_id" value="<?= $hotel['id'] ?>">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Check-in</label>
                            <input type="date" name="check_in" class="form-control" required min="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Check-out</label>
                            <input type="date" name="check_out" class="form-control" required min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tipe Kamar</label>
                            <select class="form-select" name="room_type_id" required>
                                <option value="">Pilih Tipe Kamar</option>
                                <?php foreach ($room_types as $room): ?>
                                <option value="<?= $room['id'] ?>"><?= esc($room['name']) ?> (<?= number_to_currency($room['base_price'], 'IDR') ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah Kamar</label>
                            <select class="form-select" name="rooms" required>
                                <option value="1" selected>1 Kamar</option>
                                <option value="2">2 Kamar</option>
                                <option value="3">3 Kamar</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" style="background-color: #0176C8; border-color: #0176C8;">
                            Cek Ketersediaan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Hotel Serupa -->
    <?php if (!empty($similar_hotels)): ?>
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="font-heading mb-4">Hotel Serupa di <?= esc($hotel['city_name']) ?></h3>
            <div class="row">
                <?php foreach ($similar_hotels as $similar): ?>
                <div class="col-md-4 mb-4">
                    <?= view('components/card_hotel', ['hotel' => $similar]) ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php echo $this->endSection() ?>