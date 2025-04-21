<?= $this->extend('templates/header') ?>

<?= $this->section('content') ?>
<!-- Hero Banner -->
<div class="hero-banner" style="background: url('/assets/images/banner.jpg') no-repeat center; height: 500px; background-size: cover;">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-md-8 text-white">
                <h1 class="display-4">Temukan Hotel Terbaik</h1>
                <p class="lead">Lebih dari 1000 hotel di seluruh Indonesia siap memenuhi kebutuhan Anda</p>
                
                <?= form_open('/hotels', ['class' => 'row g-3']) ?>
                    <div class="col-md-8">
                        <select name="city_id" class="form-select form-select-lg">
                            <option value="">Pilih Kota</option>
                            <?php foreach ($popularCities as $city): ?>
                            <option value="<?= $city['id'] ?>"><?= esc($city['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<!-- Promo Carousel -->
<div class="container my-5">
    <h2 class="text-center mb-4">Promo Spesial</h2>
    <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($promoBanners as $index => $banner): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                <img src="/assets/images/<?= $banner['image'] ?>" class="d-block w-100 rounded" alt="<?= esc($banner['title']) ?>">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                    <h5><?= esc($banner['title']) ?></h5>
                    <p><?= esc($banner['subtitle']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>

<!-- Featured Hotels -->
<div class="container my-5">
    <h2 class="text-center mb-4">Rekomendasi Hotel</h2>
    <div class="row">
        <?php foreach ($featuredHotels as $hotel): ?>
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="/uploads/hotels/<?= esc($hotel['cover_photo'] ?? 'default.jpg') ?>" 
                     class="card-img-top" 
                     alt="<?= esc($hotel['name']) ?>"
                     style="height: 180px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title"><?= esc($hotel['name']) ?></h5>
                    <p class="text-muted">
                        <i class="fas fa-map-marker-alt"></i> <?= esc($hotel['city_name']) ?>
                    </p>
                    <div class="rating mb-2">
                        <?php for ($i = 0; $i < $hotel['star_rating']; $i++): ?>
                            <i class="fas fa-star text-warning"></i>
                        <?php endfor; ?>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <a href="/hotels/<?= $hotel['id'] ?>" class="btn btn-primary btn-sm w-100">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Popular Cities -->
<div class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-4">Kota Populer</h2>
        <div class="row">
            <?php foreach ($popularCities as $city): ?>
            <div class="col-md-2 col-6 mb-3">
                <a href="/hotels/city/<?= $city['id'] ?>" class="text-decoration-none">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5><?= esc($city['name']) ?></h5>
                            <small class="text-muted"><?= $city['hotel_count'] ?> hotel</small>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>