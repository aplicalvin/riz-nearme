<?php echo $this->extend("layout/layout_utama"); ?>
<?php echo $this->section("konten_utama") ?>

<div class="container py-5">
    <!-- Page Header -->
    <div class="row mb-5">
        <div class="col-12">
            <h1 class="font-heading mb-3"><?= esc($title) ?></h1>
            
            <?php if ($message): ?>
                <div class="alert alert-info"><?= esc($message) ?></div>
            <?php endif; ?>
            
            <p class="text-muted"><?= count($hotels) ?> hotels found</p>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card mb-5 border-0 shadow-sm">
        <div class="card-body">
            <form method="get" action="<?= current_url() ?>">
                <div class="row g-3">
                    <!-- City Filter -->
                    <div class="col-md-4">
                        <label class="form-label">City</label>
                        <select class="form-select" name="city">
                            <option value="">All Cities</option>
                            <?php foreach ($filter_options['cities'] as $city): ?>
                                <option value="<?= esc($city) ?>" <?= (service('request')->getGet('city') === $city) ? 'selected' : '' ?>>
                                    <?= esc($city) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <!-- Star Rating Filter -->
                    <div class="col-md-3">
                        <label class="form-label">Star Rating</label>
                        <select class="form-select" name="stars">
                            <option value="">All Ratings</option>
                            <?php foreach ($filter_options['star_ratings'] as $stars): ?>
                                <option value="<?= $stars ?>" <?= (service('request')->getGet('stars') == $stars) ? 'selected' : '' ?>>
                                    <?= str_repeat('★', $stars) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <!-- Price Range Filter -->
                    <div class="col-md-3">
                        <label class="form-label">Price Range</label>
                        <select class="form-select" name="price_range">
                            <?php foreach ($filter_options['price_ranges'] as $key => $range): ?>
                                <option value="<?= $key ?>" <?= (service('request')->getGet('price_range') === $key) ? 'selected' : '' ?>>
                                    <?= esc($range) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <!-- Filter Button -->
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100" style="background-color: #FFFF6F; border-color: #FFFF6F; color: #1F1F1F;">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Hotels Listing -->
    <?php if (empty($hotels)): ?>
        <div class="text-center py-5">
            <i class="fas fa-hotel fa-4x mb-3" style="color: #6D6D6D;"></i>
            <h3 class="font-heading">No hotels found</h3>
            <p class="text-muted">Try adjusting your filters</p>
            <a href="<?= current_url() ?>" class="btn btn-outline-secondary">Reset Filters</a>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($hotels as $hotel): ?>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <?= view('components/card_hotel', ['hotel' => $hotel]) ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Pagination (static for now) -->
    <nav class="mt-5">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
</div>

<?php echo $this->endSection() ?>