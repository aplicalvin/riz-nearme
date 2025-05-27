<?php echo $this->extend("layout/layout_utama"); ?>
<?php echo $this->section("konten_utama") ?>

<!-- Hero Section - Improved with Animation -->
<section class="hero-section position-relative" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('<?= base_url('assets/images/landing.png') ?>'); background-size: cover; background-position: center; min-height: 80vh; color: white; display: flex; align-items: center;">
    <div class="container position-relative z-index-1">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="font-heading mb-4 animate__animated animate__fadeInDown" style="font-size: 3.5rem; line-height: 1.2; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                    Temukan Penginapan Terbaik<br>
                    <span class="text-primary" style="color: #0176C8 !important;">Dengan Harga Terjangkau</span>
                </h1>
                <p class="lead mb-5 animate__animated animate__fadeIn animate__delay-1s" style="font-size: 1.3rem; max-width: 700px; margin: 0 auto 30px; text-shadow: 0 1px 2px rgba(0,0,0,0.3);">
                    Booking hotel favorit Anda di seluruh Indonesia dengan kemudahan dan keamanan terjamin
                </p>
                
                <!-- Search Form - Enhanced -->
                <div class="search-box animate__animated animate__fadeInUp animate__delay-1s" style="background: rgba(255,255,255,0.95); padding: 25px; border-radius: 12px; max-width: 900px; margin: 0 auto; box-shadow: 0 8px 30px rgba(0,0,0,0.2);">
                    <form action="<?= base_url('/search') ?>" method="get">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-5">
                                <label class="form-label text-start w-100 text-dark">Lokasi</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-geo-alt text-muted"></i></span>
                                    <input type="text" class="form-control form-control-lg border-start-0" placeholder="Kota atau nama hotel" name="location" style="height: 55px;">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label text-start w-100 text-dark">Check-in</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-calendar-event text-muted"></i></span>
                                    <input type="date" class="form-control form-control-lg border-start-0" name="checkin" style="height: 55px;">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label text-start w-100 text-dark">Check-out</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-calendar-event text-muted"></i></span>
                                    <input type="date" class="form-control form-control-lg border-start-0" name="checkout" style="height: 55px;">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary w-100 h-100" style="background-color: #0176C8; border: none; font-weight: bold;">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ======== Destinasi Populer - Enhanced ======== -->
<section class="popular-destinations py-5" style="background-color: #F8F9FA;">
    <div class="container">
        <div class="section-header text-center mb-6">
            <h2 class="font-heading mb-3 position-relative d-inline-block">
                Destinasi Populer
                <span class="section-title-decoration" style="position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 80px; height: 3px; background: #0176C8;"></span>
            </h2>
            <p class="text-muted mx-auto" style="max-width: 700px;">Temukan hotel terbaik di destinasi favorit para traveler</p>
        </div>
                
        <div class="row g-4">
            <?php 
            // Ambil hanya 4 destinasi pertama
            $limited_destinations = array_slice($popular_destinations, 0, 4);
            foreach ($limited_destinations as $destination): ?>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <a href="<?= base_url('/hotels?location=' . urlencode($destination['name'])) ?>" class="destination-link text-decoration-none">
                        <div class="destination-card h-100 overflow-hidden position-relative" style="border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); transition: all 0.3s ease;">
                            <div class="p-4 bg-white">
                                <h5 class="font-heading mb-1"><?= $destination['name'] ?></h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted"><?= $destination['hotel_count'] ?> hotel tersedia</small>
                                    <span class="badge bg-primary" style="background-color: #0176C8 !important;">Populer</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-5">
            <a href="<?= base_url('/destinations') ?>" class="btn btn-outline-primary px-4 py-2" style="border-color: #0176C8; color: #0176C8;">
                Lihat Semua Destinasi <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- ======== Hotel Populer - Enhanced ======== -->
<section class="featured-hotels py-5">
    <div class="container">
        <div class="section-header d-flex flex-column flex-md-row justify-content-between align-items-center mb-5">
            <div class="text-center text-md-start mb-2 mb-md-0">
                <h2 class="font-heading mb-2 position-relative d-inline-block">
                    Rekomendasi Hotel
                    <span class="section-title-decoration" style="position: absolute; bottom: -8px; left: 0; width: 60px; height: 3px; background: #0176C8;"></span>
                </h2>
                <p class="text-muted">Hotel pilihan dengan rating tertinggi dari pelanggan</p>
            </div>
            <a href="<?= base_url('/hotels') ?>" class="btn btn-outline-dark px-4 py-2 d-flex align-items-center">
                Lihat Semua <i class="bi bi-chevron-right ms-2"></i>
            </a>
        </div>
        
        <div class="row g-4">
            <?php foreach ($hotels as $hotel): ?>
            <div class="col-xl-3 col-lg-4 col-md-6">
                <?= view('components/card_hotel', ['hotel' => $hotel]) ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Mengapa Memilih Kami - Enhanced -->
<section class="why-choose-us py-5 position-relative" style="background-color: #1F1F1F; color: white; overflow: hidden;">
    <div class="container position-relative z-index-1">
        <div class="section-header text-center mb-6">
            <h2 class="font-heading mb-3 position-relative d-inline-block text-white">
                Kenapa Memilih NearMe?
                <span class="section-title-decoration" style="position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 80px; height: 3px; background: #0176C8;"></span>
            </h2>
            <p class="text-light mx-auto" style="max-width: 700px; opacity: 0.9;">Kami memberikan pengalaman terbaik dalam memesan penginapan</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="feature-card p-4 h-100" style="background: rgba(255,255,255,0.05); border-radius: 12px; transition: all 0.3s ease; border: 1px solid rgba(255,255,255,0.1);">
                    <div class="feature-icon mb-4" style="width: 70px; height: 70px; background: rgba(1, 118, 200, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-percent fa-2x" style="color: #0176C8;"></i>
                    </div>
                    <h4 class="font-heading mb-3">Harga Terbaik</h4>
                    <p class="mb-0" style="opacity: 0.8;">Jaminan harga terbaik dengan penawaran eksklusif dan diskon spesial untuk member</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card p-4 h-100" style="background: rgba(255,255,255,0.05); border-radius: 12px; transition: all 0.3s ease; border: 1px solid rgba(255,255,255,0.1);">
                    <div class="feature-icon mb-4" style="width: 70px; height: 70px; background: rgba(1, 118, 200, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-headset fa-2x" style="color: #0176C8;"></i>
                    </div>
                    <h4 class="font-heading mb-3">Bantuan 24/7</h4>
                    <p class="mb-0" style="opacity: 0.8;">Tim dukungan kami siap membantu Anda kapan saja melalui chat, telepon, atau email</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card p-4 h-100" style="background: rgba(255,255,255,0.05); border-radius: 12px; transition: all 0.3s ease; border: 1px solid rgba(255,255,255,0.1);">
                    <div class="feature-icon mb-4" style="width: 70px; height: 70px; background: rgba(1, 118, 200, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-shield-alt fa-2x" style="color: #0176C8;"></i>
                    </div>
                    <h4 class="font-heading mb-3">Pembayaran Aman</h4>
                    <p class="mb-0" style="opacity: 0.8;">Sistem pembayaran terenkripsi dengan berbagai metode pembayaran yang aman</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card p-4 h-100" style="background: rgba(255,255,255,0.05); border-radius: 12px; transition: all 0.3s ease; border: 1px solid rgba(255,255,255,0.1);">
                    <div class="feature-icon mb-4" style="width: 70px; height: 70px; background: rgba(1, 118, 200, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-map fa-2x" style="color: #0176C8;"></i>
                    </div>
                    <h4 class="font-heading mb-3">Pilihan Luas</h4>
                    <p class="mb-0" style="opacity: 0.8;">Ribuan hotel di seluruh Indonesia dari budget hingga bintang 5</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card p-4 h-100" style="background: rgba(255,255,255,0.05); border-radius: 12px; transition: all 0.3s ease; border: 1px solid rgba(255,255,255,0.1);">
                    <div class="feature-icon mb-4" style="width: 70px; height: 70px; background: rgba(1, 118, 200, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-phone fa-2x" style="color: #0176C8;"></i>
                    </div>
                    <h4 class="font-heading mb-3">Aplikasi Mobile</h4>
                    <p class="mb-0" style="opacity: 0.8;">Pesan hotel lebih mudah dengan aplikasi mobile kami yang user-friendly</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card p-4 h-100" style="background: rgba(255,255,255,0.05); border-radius: 12px; transition: all 0.3s ease; border: 1px solid rgba(255,255,255,0.1);">
                    <div class="feature-icon mb-4" style="width: 70px; height: 70px; background: rgba(1, 118, 200, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-star fa-2x" style="color: #0176C8;"></i>
                    </div>
                    <h4 class="font-heading mb-3">Ulasan Asli</h4>
                    <p class="mb-0" style="opacity: 0.8;">Baca ulasan jujur dari tamu sebelumnya untuk membantu keputusan Anda</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ======== Testimoni Pelanggan ======== -->
<section class="testimonials py-5" style="background-color: #F8F9FA;">
    <div class="container">
        <div class="section-header text-center mb-6">
            <h2 class="font-heading mb-3 position-relative d-inline-block">
                Kata Mereka Tentang NearMe
                <span class="section-title-decoration" style="position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 80px; height: 3px; background: #0176C8;"></span>
            </h2>
            <p class="text-muted mx-auto" style="max-width: 700px;">Apa kata pelanggan yang sudah merasakan kemudahan booking dengan NearMe</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card p-4 h-100" style="background: white; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                    <div class="d-flex align-items-center mb-3">
                        <img src="<?= base_url('dummy/person.png') ?>" class="rounded-circle me-3" width="60" height="60" alt="Testimoni 1">
                        <div>
                            <h5 class="font-heading mb-0">Andi Wijaya</h5>
                            <div class="d-flex">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mb-0">"Pengalaman booking sangat mudah dan cepat. Harganya lebih murah dibanding platform lain. Sangat recommended!"</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card p-4 h-100" style="background: white; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                    <div class="d-flex align-items-center mb-3">
                        <img src="<?= base_url('dummy/person.png') ?>" class="rounded-circle me-3" width="60" height="60" alt="Testimoni 2">
                        <div>
                            <h5 class="font-heading mb-0">Sarah Fitriani</h5>
                            <div class="d-flex">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mb-0">"Customer service sangat responsif membantu ketika ada kendala. Hotelnya sesuai gambar dan deskripsi."</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card p-4 h-100" style="background: white; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                    <div class="d-flex align-items-center mb-3">
                        <img src="<?= base_url('dummy/person.png') ?>" class="rounded-circle me-3" width="60" height="60" alt="Testimoni 3">
                        <div>
                            <h5 class="font-heading mb-0">Budi Santoso</h5>
                            <div class="d-flex">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half-alt text-warning"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mb-0">"Sudah beberapa kali booking lewat NearMe dan selalu puas. Proses check-in di hotel juga cepat dan mudah."</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ======== Tentang Kami - Enhanced ======== -->
<section class="about-us py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="position-relative">
                    <img src="<?= base_url('assets/images/about.png') ?>" class="img-fluid rounded-3 shadow" alt="Tentang NearMe">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ps-lg-5">
                    <h2 class="font-heading mb-4 position-relative d-inline-block">
                        Tentang NearMe
                        <span class="section-title-decoration" style="position: absolute; bottom: -8px; left: 0; width: 60px; height: 3px; background: #0176C8;"></span>
                    </h2>
                    <p class="mb-4">
                        NearMe adalah platform pemesanan hotel terkemuka di Indonesia yang menghubungkan traveler dengan berbagai pilihan akomodasi terbaik di seluruh negeri. 
                        Kami berkomitmen untuk memberikan pengalaman booking yang mudah, aman, dan menyenangkan.
                    </p>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="d-flex">
                                <i class="fas fa-check-circle text-primary me-2 mt-1" style="color: #0176C8 !important;"></i>
                                <span>✅ Pilihan hotel terlengkap</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <i class="fas fa-check-circle text-primary me-2 mt-1" style="color: #0176C8 !important;"></i>
                                <span>✅ Jaminan harga terbaik</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <i class="fas fa-check-circle text-primary me-2 mt-1" style="color: #0176C8 !important;"></i>
                                <span>✅ Transaksi aman & terpercaya</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <i class="fas fa-check-circle text-primary me-2 mt-1" style="color: #0176C8 !important;"></i>
                                <span>✅ Dukungan pelanggan 24/7</span>
                            </div>
                        </div>
                    </div>
                    <a href="<?= base_url('/about') ?>" class="btn btn-primary px-4 py-2" style="background-color: #0176C8; border: none;">
                        Selengkapnya Tentang Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ======== CTA Section ======== -->
<section class="cta-section py-5" style="background: linear-gradient(135deg, #0176C8 0%, #0197F8 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <h3 class="font-heading mb-3" style="font-size: 1.8rem;">Mulai Petualangan Anda Sekarang</h3>
                <p class="mb-0" style="opacity: 0.9;">Download aplikasi NearMe untuk pengalaman booking yang lebih mudah dan eksklusif</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="d-flex flex-column flex-sm-row justify-content-lg-end gap-3">
                    <a href="#" class="btn btn-light px-4 py-3 d-flex align-items-center justify-content-center">
                        <i class="fab fa-google-play fa-2x me-2"></i>
                        <div class="text-start">
                            <small class="d-block" style="font-size: 0.7rem; line-height: 1;">Download on</small>
                            <span class="fw-bold">Google Play</span>
                        </div>
                    </a>
                    <a href="#" class="btn btn-light px-4 py-3 d-flex align-items-center justify-content-center">
                        <i class="fab fa-apple fa-2x me-2"></i>
                        <div class="text-start">
                            <small class="d-block" style="font-size: 0.7rem; line-height: 1;">Download on</small>
                            <span class="fw-bold">App Store</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php echo $this->endSection() ?>

<style>
/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate__animated {
    animation-duration: 1s;
    animation-fill-mode: both;
}

.animate__fadeInDown {
    animation-name: fadeInDown;
}

.animate__fadeIn {
    animation-name: fadeIn;
}

.animate__fadeInUp {
    animation-name: fadeInUp;
}

.animate__delay-1s {
    animation-delay: 1s;
}

/* Section Spacing */
.py-5 {
    padding-top: 5rem;
    padding-bottom: 5rem;
}

.mb-6 {
    margin-bottom: 4rem !important;
}

/* Destination Card Hover */
.destination-link:hover {
    text-decoration: none;
}

.destination-card {
    transition: all 0.3s ease;
}

.destination-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
}

.destination-card img {
    transition: transform 0.5s ease;
}

.destination-card:hover img {
    transform: scale(1.1);
}

/* Feature Card Hover */
.feature-card:hover {
    transform: translateY(-5px);
    background: rgba(255,255,255,0.1) !important;
    border-color: rgba(1, 118, 200, 0.3) !important;
}

/* Testimonial Card */
.testimonial-card {
    transition: all 0.3s ease;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .hero-section h1 {
        font-size: 2.5rem !important;
    }
    
    .hero-section p {
        font-size: 1.1rem !important;
    }
    
    .search-box {
        padding: 15px !important;
    }
}

/* Object Fit Polyfill */
.object-fit-cover {
    object-fit: cover;
    font-family: 'object-fit: cover;';
}
</style>