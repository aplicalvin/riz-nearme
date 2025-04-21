<?= $this->extend('templates/header') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/hotels">Hotel</a></li>
                <li class="breadcrumb-item active"><?= esc($hotel['name']) ?></li>
            </ol>
        </nav>

        <h2><?= esc($hotel['name']) ?></h2>
        <div class="rating mb-3">
            <?php for ($i = 0; $i < $hotel['star_rating']; $i++): ?>
                <i class="fas fa-star"></i>
            <?php endfor; ?>
            <span class="ms-2"><?= $hotel['star_rating'] ?> bintang</span>
        </div>

        <div class="mb-4">
            <img src="/uploads/hotels/<?= esc($hotel['cover_photo'] ?? 'default.jpg') ?>" 
                 class="img-fluid rounded" 
                 alt="<?= esc($hotel['name']) ?>">
        </div>

        <h4><i class="fas fa-info-circle text-primary"></i> Deskripsi</h4>
        <p class="mb-4"><?= nl2br(esc($hotel['description'])) ?></p>

        <h4><i class="fas fa-map-marked-alt text-primary"></i> Alamat</h4>
        <p class="mb-4"><?= esc($hotel['address']) ?></p>

        <h4><i class="fas fa-umbrella-beach text-primary"></i> Fasilitas</h4>
        <div class="row mb-4">
            <?php foreach ($facilities as $facility): ?>
            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h6><i class="<?= esc($facility['icon'] ?? 'fas fa-check') ?> text-primary"></i> 
                            <?= esc($facility['name']) ?>
                        </h6>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <h4><i class="fas fa-door-open text-primary"></i> Tipe Kamar</h4>
        <div class="row">
            <?php foreach ($rooms as $room): ?>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5><?= esc($room['name']) ?></h5>
                        <p class="text-success fw-bold">Rp <?= number_format($room['base_price'], 0, ',', '.') ?>/malam</p>
                        <p>Kapasitas: <?= $room['capacity'] ?> orang</p>
                        <a href="/bookings/create/<?= $room['id'] ?>" class="btn btn-primary">
                            <i class="fas fa-calendar-check"></i> Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card sticky-top" style="top: 20px;">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> Lokasi</h5>
            </div>
            <div class="card-body">
                <!-- Tempat untuk map (Google Maps API bisa ditambahkan) -->
                <div id="hotel-map" style="height: 300px; background: #eee; border-radius: 5px;"></div>
                <hr>
                <h6><i class="fas fa-phone"></i> Kontak</h6>
                <p><?= esc($hotel['phone'] ?? 'Belum tersedia') ?></p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>