<?php echo $this->extend("layout/l_admin"); ?>
<?php echo $this->section("content"); ?>
<div class="container">
   <h3 class="font-heading">Welcome! <span class="fw-bold"><?= session()->get('full_name') ?> </span></h3>
   <h6>Pengelola hotel <span class="fw-bold">Grand Panorama</span></h6>
</div>

<hr>
<!-- Statistik -->
 <div class="container">
    <h2 class="font-heading">Statistik </h2>
    <!-- Buat ada 3 kolom dimana tertulis  -->
      <div>

      </div>
 </div>
<!-- Statistik -->
<?php echo $this->endSection() ?>