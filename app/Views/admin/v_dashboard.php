<?php echo $this->extend("layout/l_admin"); ?>
<?php echo $this->section("content"); ?>

<div class="container">
    <h3 class="font-heading mb-4">Welcome! <span class="fw-bold text-primary"><?= esc(session()->get('full_name')) ?></span></h3>

    <?php if (!empty($hotels)): ?>
        <div class="d-flex flex-column flex-md-row gap-4 align-items-start mb-4">
            <!-- Display cover photo if exists -->
            <?php if (!empty($hotels['cover_photo'])): ?>
                <div>
                    <img src="/uploads/hotels/<?= esc($hotels['cover_photo']) ?>" 
                        alt="<?= esc($hotels['name']) ?>" 
                        class="rounded-4 shadow-sm" style="width: 320px; height: 200px; object-fit: cover;">
                </div>
            <?php endif; ?>

            <!-- INFORMASI DI SAMPING -->
            <div class="bg-light p-3 rounded-4 shadow-sm w-100">
                <h4 class="mb-2">Pengelola Hotel <span class="fw-bold text-success"><?= esc($hotels['name']) ?></span></h4>
                <p class="mb-1"><i class="fas fa-map-marker-alt me-2 text-danger"></i> <?= esc($hotels['address']) ?></p>
                
                <?php if (!empty($hotels['star_rating'])): ?>
                    <div class="mt-2">
                        <span class="badge bg-warning text-dark">
                            <?= str_repeat('★', $hotels['star_rating']) ?> (<?= $hotels['star_rating'] ?>/5)
                        </span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">
            Anda belum memiliki hotel terdaftar.
        </div>
    <?php endif; ?>
</div>

<hr>

<!-- Statistik -->
<div class="container">
    <h5 class="font-heading mb-3">📊 Statistik</h5>        
    <div class="row">
        <!-- Card Total Kamar -->
        <div class="col-md-4 mb-4">
            <div class="card border-start border-primary border-4 shadow-sm hover-shadow transition">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-uppercase text-primary fw-bold small mb-1">Total Kamar</div>
                        <div class="h5 fw-bold"><?= $stats['total_rooms'] ?></div>
                    </div>
                    <i class="fas fa-bed fa-2x text-primary"></i>
                </div>
            </div>
        </div>

        <!-- Card Kamar Tersedia -->
        <div class="col-md-4 mb-4">
            <div class="card border-start border-success border-4 shadow-sm hover-shadow transition">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-uppercase text-success fw-bold small mb-1">Kamar Tersedia</div>
                        <div class="h5 fw-bold"><?= $stats['available_rooms'] ?></div>
                    </div>
                    <i class="fas fa-door-open fa-2x text-success"></i>
                </div>
            </div>
        </div>

        <!-- Card Total Booking -->
        <div class="col-md-4 mb-4">
            <div class="card border-start border-info border-4 shadow-sm hover-shadow transition">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-uppercase text-info fw-bold small mb-1">Total Booking</div>
                        <div class="h5 fw-bold"><?= $stats['total_bookings'] ?></div>
                    </div>
                    <i class="fas fa-calendar-alt fa-2x text-info"></i>
                </div>
            </div>
        </div>

        <!-- Card Booking Hari Ini -->
        <div class="col-md-4 mb-4">
            <div class="card border-start border-warning border-4 shadow-sm hover-shadow transition">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-uppercase text-warning fw-bold small mb-1">Booking Hari Ini</div>
                        <div class="h5 fw-bold"><?= $stats['today_bookings'] ?></div>
                    </div>
                    <i class="fas fa-calendar-day fa-2x text-warning"></i>
                </div>
            </div>
        </div>

        <!-- Card Booking Aktif -->
        <div class="col-md-4 mb-4">
            <div class="card border-start border-danger border-4 shadow-sm hover-shadow transition">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-uppercase text-danger fw-bold small mb-1">Booking Aktif</div>
                        <div class="h5 fw-bold"><?= $stats['active_bookings'] ?></div>
                    </div>
                    <i class="fas fa-calendar-check fa-2x text-danger"></i>
                </div>
            </div>
        </div>

        <!-- Card Rating Hotel -->
        <div class="col-md-4 mb-4">
            <div class="card border-start border-secondary border-4 shadow-sm hover-shadow transition">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-uppercase text-secondary fw-bold small mb-1">Rating Hotel</div>
                        <div class="h5 fw-bold"><?= str_repeat('★', $hotel['star_rating'] ?? 0) ?></div>
                    </div>
                    <i class="fas fa-star fa-2x text-secondary"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Statistik -->

<?php echo $this->endSection() ?>


<style>
    .hover-shadow:hover {
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15) !important;
    transition: 0.3s ease-in-out;
}
.transition {
    transition: all 0.3s ease-in-out;
}

</style>