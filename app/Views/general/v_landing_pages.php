<?php echo $this->extend("layout/layout_utama"); ?>
<?php echo $this->section("konten_utama") ?>

<!-- Hero Section -->
<section class="hero-section" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('<?= base_url('assets/images/landing.png') ?>'); background-size: cover; background-position: center; padding: 120px 0; color: white; text-align: center;">
    <div class="container">
        <h1 class="font-heading" style="font-size: 3rem; margin-bottom: 20px;">Temukan Penginapan Terbaik di Dekatmu</h1>
        <p style="font-size: 1.2rem; max-width: 700px; margin: 0 auto 30px;">Booking hotel favorit dengan harga terjangkau di seluruh Indonesia bersama NearMe</p>
        
        <!-- Search Form -->
        <div class="search-box" style="background: white; padding: 20px; border-radius: 8px; max-width: 800px; margin: 0 auto; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <form action="<?= base_url('/search') ?>" method="get">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control form-control-lg" placeholder="Mau ke mana?" name="location" style="height: 50px;">
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control form-control-lg" name="checkin" style="height: 50px;">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100" style="height: 50px; background-color: #0176C8; border: none; color: #F6F6F6; font-weight: bold;">Cari Hotel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- ======== Destinasi Populer ======== -->
<section class="popular-destinations" style="padding: 60px 0; background-color: #F8F9FA;">
    <div class="container">
        <h2 class="font-heading text-center mb-5">Destinasi Populer</h2>
        <div class="row">
            <?php
            $destinations = [
                ['name' => 'Bali', 'image' => 'https://picsum.photos/300/200'],
                ['name' => 'Jakarta', 'image' => 'https://picsum.photos/300/200'],
                ['name' => 'Yogyakarta', 'image' => 'https://picsum.photos/300/200'],
                ['name' => 'Bandung', 'image' => 'https://picsum.photos/300/200']
            ];
            ?>
            
            <?php foreach ($destinations as $destination): ?>
                <div class="col-md-3 mb-4">
                    <a href="<?= base_url('/hotels?location=' . urlencode($destination['name'])) ?>" 
                    class="destination-link" 
                    style="text-decoration: none; color: inherit;">
                        <div class="destination-card" style="border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1); transition: transform 0.3s;">
                            <img src="<?= $destination['image'] ?>" 
                                alt="<?= 'Hotel di ' . $destination['name'] ?>" 
                                style="width: 100%; height: 150px; object-fit: cover;">
                            <div class="p-3" style="background: white;">
                                <h5 class="font-heading mb-0"><?= $destination['name'] ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ======== Hotel Populer ======== -->
<section class="featured-hotels" style="padding: 60px 0;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="font-heading mb-0">Hotel Paling Populer</h2>
            <a href="<?= base_url('/hotels') ?>" class="btn btn-outline-dark">Lihat Semua</a>
        </div>
        
        <div class="row">
            <?php foreach ($hotels as $hotel): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <?= view('components/card_hotel', ['hotel' => $hotel]) ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Mengapa Memilih Kami -->
<section class="why-choose-us" style="padding: 60px 0; background-color: #1F1F1F; color: white;">
    <div class="container">
        <h2 class="font-heading text-center mb-5">Kenapa Pilih NearMe?</h2>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="p-4">
                    <i class="fas fa-percentage fa-3x mb-3" style="color: #0176C8;"></i>
                    <h4 class="font-heading">Jaminan Harga Terbaik</h4>
                    <p>Dapatkan harga terbaik untuk setiap pemesanan. Temukan lebih murah? Kami siap samakan!</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4">
                    <i class="fas fa-headset fa-3x mb-3" style="color: #0176C8;"></i>
                    <h4 class="font-heading">Bantuan 24/7</h4>
                    <p>Tim dukungan kami siap membantu Anda kapan saja, di mana saja.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4">
                    <i class="fas fa-map-marked-alt fa-3x mb-3" style="color: #0176C8;"></i>
                    <h4 class="font-heading">Pilihan Terlengkap</h4>
                    <p>Pilih dari ribuan hotel di seluruh Indonesia untuk perjalanan Anda yang sempurna.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ======== Tentang Kami ======== -->
<section class="tentang-kami" style="padding: 60px 0; background-color: #F8F9FA;">
    <div class="container">
        <h2 class="font-heading text-center mb-4">Tentang NearMe</h2>
        <p class="text-center mb-5" style="max-width: 800px; margin: 0 auto; font-size: 1.1rem;">
            NearMe adalah platform pemesanan hotel yang hadir untuk memudahkan Anda menemukan penginapan terbaik di seluruh Indonesia. Kami percaya, setiap perjalanan—baik untuk bekerja maupun liburan—layak mendapatkan kenyamanan dan kemudahan dalam memilih tempat menginap.
        </p>

        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="p-4">
                    <i class="fas fa-globe-asia fa-3x mb-3" style="color: #0176C8;"></i>
                    <h5 class="font-heading">Cakupan Nasional</h5>
                    <p>Dari Sabang sampai Merauke, temukan ribuan pilihan hotel di berbagai kota dan destinasi wisata.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4">
                    <i class="fas fa-user-check fa-3x mb-3" style="color: #0176C8;"></i>
                    <h5 class="font-heading">Dipercaya Ribuan Pengguna</h5>
                    <p>Sudah ribuan pengguna puas memesan hotel melalui NearMe. Kini giliran Anda!</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4">
                    <i class="fas fa-mobile-alt fa-3x mb-3" style="color: #0176C8;"></i>
                    <h5 class="font-heading">Mudah & Cepat</h5>
                    <p>Pesan hotel hanya dalam beberapa klik lewat website atau aplikasi kami. Simpel dan efisien.</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="<?= base_url('/about') ?>" class="btn btn-primary" style="background-color: #0176C8; border: none;">Selengkapnya Tentang Kami</a>
        </div>
    </div>
</section>


<?php echo $this->endSection() ?>

<style>
.destination-link:hover {
    outline: none;
}

.destination-card {
    display: block;
    height: 100%;
}

.destination-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}

.destination-card img {
    transition: transform 0.3s ease;
}

.destination-card:hover img {
    transform: scale(1.05);
}
</style>
