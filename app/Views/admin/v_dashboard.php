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
               <img src="/uploads/<?= esc($hotels['cover_photo']) ?>" 
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
        <?php if (!empty($hotels)): ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Hotel Anda</h5>
                        <p class="card-text">
                            <strong><?= esc($hotels['name']) ?></strong><br>
                            <?= esc($hotels['address']) ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- You can add more statistics cards here -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Kamar</h5>
                    <p class="card-text">0</p> <!-- Replace with actual room count -->
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Booking Hari Ini</h5>
                    <p class="card-text">0</p> <!-- Replace with actual booking count -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Statistik -->
<?php echo $this->endSection() ?>