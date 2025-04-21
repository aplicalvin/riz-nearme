<?= $this->extend('templates/header') ?>

<?= $this->section('content') ?>
<div class="row mb-4">
    <div class="col-md-6">
        <h1><i class="fas fa-hotel text-primary"></i> Daftar Hotel</h1>
    </div>
    <div class="col-md-6">
        <form action="/hotels" method="get">
            <div class="input-group">
                <select name="city_id" class="form-select">
                    <option value="">Semua Kota</option>
                    <?php foreach ($cities as $city): ?>
                    <option value="<?= $city['id'] ?>" <?= ($city['id'] == ($_GET['city_id'] ?? '')) ? 'selected' : '' ?>>
                        <?= esc($city['name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <?php if (empty($hotels)): ?>
        <div class="col-12">
            <div class="alert alert-info">Tidak ada hotel yang ditemukan</div>
        </div>
    <?php else: ?>
        <?php foreach ($hotels as $hotel): ?>
        <div class="col-md-4 mb-4">
            <div class="card hotel-card h-100">
                <img src="/uploads/hotels/<?= esc($hotel['cover_photo'] ?? 'default.jpg') ?>" 
                     class="card-img-top" 
                     alt="<?= esc($hotel['name']) ?>"
                     style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title"><?= esc($hotel['name']) ?></h5>
                    <p class="text-muted">
                        <i class="fas fa-map-marker-alt text-danger"></i> <?= esc($hotel['city_name']) ?>
                    </p>
                    <div class="rating mb-2">
                        <?php for ($i = 0; $i < $hotel['star_rating']; $i++): ?>
                            <i class="fas fa-star"></i>
                        <?php endfor; ?>
                    </div>
                    <a href="/hotels/<?= $hotel['id'] ?>" class="btn btn-primary">
                        <i class="fas fa-search"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>