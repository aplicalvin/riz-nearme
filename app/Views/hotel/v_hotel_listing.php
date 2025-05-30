<?php echo $this->extend("layout/layout_utama"); ?>
<?php echo $this->section("konten_utama") ?>

<div class="container py-5">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="font-heading mb-2"><?= esc($title) ?></h1>

            <?php if ($message): ?>
                <div class="alert alert-info"><?= esc($message) ?></div>
            <?php endif; ?>

            <p class="text-muted">Menampilkan <span class="badge bg-primary"><?= count($hotels) ?></span> hotel</p>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card mb-5 border-0 shadow-lg bg-light">
        <div class="card-header bg-white border-bottom-0">
            <h5 class="mb-0"><i class="fas fa-search-location me-2 text-primary"></i>Filter Pencarian</h5>
        </div>
        <div class="card-body">
            <form method="get" action="<?= current_url() ?>">
                <div class="row g-3">
                    <!-- City -->
                    <div class="col-md-4">
                        <label class="form-label"><i class="fas fa-city me-1 text-secondary"></i> Kota</label>
                        <select class="form-select" name="city">
                            <option value="">Semua Kota</option>
                            <?php foreach ($filter_options['cities'] as $city): ?>
                                <option value="<?= esc($city) ?>" <?= (service('request')->getGet('city') === $city) ? 'selected' : '' ?>>
                                    <?= esc($city) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Star -->
                    <div class="col-md-3">
                        <label class="form-label"><i class="fas fa-star me-1 text-warning"></i> Rating</label>
                        <select class="form-select" name="stars">
                            <option value="">Semua Rating</option>
                            <?php foreach ($filter_options['star_ratings'] as $stars): ?>
                                <option value="<?= $stars ?>" <?= (service('request')->getGet('stars') == $stars) ? 'selected' : '' ?>>
                                    <?= str_repeat('★', $stars) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Price -->
                    

                    <!-- Submit -->
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100 fw-semibold shadow-sm">
                            <i class="fas fa-filter me-1"></i> Terapkan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Hotel List -->
    <?php if (empty($hotels)): ?>
        <div class="text-center py-5">
            <i class="fas fa-hotel fa-4x mb-3 text-secondary"></i>
            <h4 class="font-heading">Tidak ada hotel ditemukan</h4>
            <p class="text-muted">Coba ubah filter pencarian Anda.</p>
            <a href="<?= current_url() ?>" class="btn btn-outline-secondary">Reset Filter</a>
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

    <!-- Pagination Placeholder -->
    <!-- Ganti bagian pagination dengan ini -->
    <?php if (isset($pager) && $total_results > $per_page): ?>
        <nav class="mt-5">
            <?= $pager->links('default', 'front_full') ?>
        </nav>
    <?php endif; ?>

    <!-- Tambahkan info pagination -->
    <div class="text-muted text-center mt-3">
        Menampilkan <?= (($current_page - 1) * $per_page) + 1 ?> - 
        <?= min($current_page * $per_page, $total_results) ?> 
        dari <?= number_format($total_results) ?> hotel
    </div>
</div>

<?php echo $this->endSection() ?>
