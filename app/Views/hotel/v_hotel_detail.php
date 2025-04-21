<?php echo $this->extend("layout/layout_utama"); ?>
<?php echo $this->section("konten_utama") ?>

<div class="container py-5">
    <!-- Header Hotel -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="font-heading"><?= esc($hotel['name']) ?></h1>
            <div class="d-flex align-items-center mb-2">
                <div class="me-3" style="color: #FFD700;">
                    <?= str_repeat('★', (int)$hotel['stars']) ?><?= str_repeat('☆', 5 - (int)$hotel['stars']) ?>
                </div>
                <span class="badge text-dark me-2" style="background-color: #075085;"><?= number_format($hotel['rating'], 1) ?> / 5</span>
                <span class="text-muted">(<?= $hotel['review_count'] ?> ulasan)</span>
            </div>
            <div class="d-flex align-items-center text-muted mb-3">
                <i class="fas fa-map-marker-alt me-2"></i>
                <?= esc($hotel['city']) ?>, <?= esc($hotel['province'] ?? 'Indonesia') ?>
            </div>
        </div>
        <div class="col-md-4 text-md-end">
            <button class="btn btn-lg btn-primary" style="background-color: #0176C8; border-color: #0176C8; color: #1F1F1F;">
                <i class="fas fa-calendar-alt me-2"></i>Pesan Sekarang
            </button>
        </div>
    </div>

    <!-- Galeri Hotel -->
    <div class="row mb-5">
        <div class="col-md-8 mb-3 mb-md-0">
            <div class="main-image" style="height: 400px; background-image: url('<?= $hotel['image'] ?>'); background-size: cover; background-position: center; border-radius: 8px;"></div>
        </div>
        <div class="col-md-4">
            <div class="row g-2">
                <div class="col-6">
                    <div class="thumbnail" style="height: 120px; background-image: url('https://source.unsplash.com/random/300x200/?hotel,room'); background-size: cover; border-radius: 4px; cursor: pointer;"></div>
                </div>
                <div class="col-6">
                    <div class="thumbnail" style="height: 120px; background-image: url('https://source.unsplash.com/random/300x200/?hotel,lobby'); background-size: cover; border-radius: 4px; cursor: pointer;"></div>
                </div>
                <div class="col-6">
                    <div class="thumbnail" style="height: 120px; background-image: url('https://source.unsplash.com/random/300x200/?hotel,pool'); background-size: cover; border-radius: 4px; cursor: pointer;"></div>
                </div>
                <div class="col-6">
                    <div class="thumbnail" style="height: 120px; background-image: url('https://source.unsplash.com/random/300x200/?hotel,restaurant'); background-size: cover; border-radius: 4px; cursor: pointer;"></div>
                </div>
                <div class="col-12 mt-2">
                    <button class="btn btn-sm btn-outline-secondary w-100">
                        <i class="fas fa-images me-1"></i> Lihat Semua Foto
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Hotel -->
    <div class="row">
        <div class="col-lg-8">
            <!-- Deskripsi -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="font-heading mb-4">Tentang Hotel Ini</h3>
                    <p><?= esc($hotel['description'] ?? 'Hotel mewah ini menawarkan akomodasi premium dengan layanan dan fasilitas yang luar biasa. Terletak di pusat kota, hotel ini memberikan akses mudah ke tempat wisata dan area bisnis.') ?></p>
                </div>
            </div>

            <!-- Fasilitas -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="font-heading mb-4">Fasilitas & Layanan</h3>
                    <div class="row">
                        <?php 
                        $facilities = $hotel['facilities'] ?? [
                            'WiFi Gratis', 'Kolam Renang', 'Restoran', 
                            'Spa', 'Pusat Kebugaran', 'AC',
                            'Resepsionis 24 Jam', 'Pusat Bisnis', 'Parkir'
                        ];
                        
                        foreach ($facilities as $facility): ?>
                        <div class="col-md-4 mb-2">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span><?= esc($facility) ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Ulasan -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="font-heading mb-4">Ulasan Tamu</h3>
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-4 text-center">
                            <h2 class="mb-0"><?= number_format($hotel['rating'], 1) ?></h2>
                            <div class="text-warning">
                                <?= str_repeat('★', round($hotel['rating'])) ?>
                            </div>
                            <small class="text-muted"><?= $hotel['review_count'] ?> ulasan</small>
                        </div>
                        <div class="flex-grow-1">
                            <?php 
                            $ratingBars = [
                                5 => 70,
                                4 => 20,
                                3 => 5,
                                2 => 3,
                                1 => 2
                            ];
                            foreach ($ratingBars as $stars => $percent): ?>
                            <div class="d-flex align-items-center mb-2">
                                <small class="me-2"><?= $stars ?> bintang</small>
                                <div class="progress flex-grow-1" style="height: 8px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $percent ?>%;" aria-valuenow="<?= $percent ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="ms-2 text-muted"><?= $percent ?>%</small>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <!-- Contoh Ulasan -->
                    <div class="review">
                        <div class="d-flex justify-content-between mb-2">
                            <h5 class="mb-0">Sangat Memuaskan</h5>
                            <div class="text-warning">★★★★★</div>
                        </div>
                        <p class="text-muted">Oleh John D. pada <?= date('M Y') ?></p>
                        <p>Hotel ini luar biasa! Lokasi strategis, staf ramah, dan kamar sangat bersih. Pasti akan kembali menginap di sini lagi.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Pemesanan -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                <div class="card-body">
                    <h3 class="font-heading mb-4">Cek Ketersediaan</h3>
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Check-in</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Check-out</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tamu</label>
                            <select class="form-select">
                                <option>1 Dewasa</option>
                                <option selected>2 Dewasa</option>
                                <option>3 Dewasa</option>
                                <option>4 Dewasa</option>
                                <option>Keluarga (2 Dewasa + 2 Anak)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kamar</label>
                            <select class="form-select">
                                <option selected>1 Kamar</option>
                                <option>2 Kamar</option>
                                <option>3 Kamar</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" style="background-color: #0176C8; border-color: #0176C8; color: #1F1F1F;">
                            Cek Ketersediaan
                        </button>
                    </form>
                    
                    <hr class="my-4">
                    
                    <h4 class="font-heading mb-3">Ringkasan Harga</h4>
                    <div class="d-flex justify-content-between mb-2">
                        <span>1 Malam x 2 Dewasa</span>
                        <span>Rp 1.200.000</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Pajak & Biaya</span>
                        <span>Rp 120.000</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total</span>
                        <span>Rp 1.320.000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hotel Serupa -->
    <?php if (!empty($similar_hotels)): ?>
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="font-heading mb-4">Hotel Serupa di <?= esc($hotel['city']) ?></h3>
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
