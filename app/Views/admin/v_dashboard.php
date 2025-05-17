<?php echo $this->extend("layout/l_admin"); ?>
<?php echo $this->section("content"); ?>
<div class="container">
   <h3 class="font-heading">Welcome! <span class="fw-bold"><?= esc(session()->get('full_name')) ?></span></h3>
   
   <?php if (!empty($hotels)): ?>
       <!-- Display first hotel if exists (assuming one admin manages one hotel) -->
       <h6>Pengelola hotel <span class="fw-bold"><?= esc($hotels['name']) ?></span></h6>
       <p>Alamat: <?= esc($hotels['address']) ?></p>
       
       <!-- Display star rating if exists -->
       <?php if (!empty($hotels['star_rating'])): ?>
           <div class="mt-2">
               Rating: <?= str_repeat('★', $hotels['star_rating']) ?>
           </div>
       <?php endif; ?>
       
       <!-- Display cover photo if exists -->
       <?php if (!empty($hotels['cover_photo'])): ?>
           <div class="mt-3">
               <img src="/uploads/hotels/<?= esc($hotels['cover_photo']) ?>" 
                    alt="<?= esc($hotels['name']) ?>" 
                    class="img-thumbnail" style="max-width: 300px;">
           </div>
       <?php endif; ?>
   <?php else: ?>
       <div class="alert alert-warning">
           Anda belum memiliki hotel terdaftar.
       </div>
   <?php endif; ?>
</div>

<hr>
<!-- Statistik -->
<div class="container">
    <h5 class="font-heading">Statistik</h5>        
    <div class="row">
        <!-- Card Total Kamar -->
        <div class="col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Kamar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $stats['total_rooms'] ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bed fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Kamar Tersedia -->
        <div class="col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Kamar Tersedia</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $stats['available_rooms'] ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-door-open fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Total Booking -->
        <div class="col-md-4 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Booking</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $stats['total_bookings'] ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Booking Hari Ini -->
        <div class="col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Booking Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $stats['today_bookings'] ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Booking Aktif -->
        <div class="col-md-4 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Booking Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $stats['active_bookings'] ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Informasi Hotel -->
        <div class="col-md-4 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                Rating Hotel</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= str_repeat('★', $hotel['star_rating'] ?? 0) ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Statistik -->
<?php echo $this->endSection() ?>