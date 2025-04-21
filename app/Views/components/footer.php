<!-- Footer -->
<footer class="bg-dark text-white pt-5 pb-4" style="background-color: #1F1F1F !important;">
    <div class="container">
        <div class="row">
            <!-- Kolom Tentang -->
            <div class="col-md-4 mb-4">
                <h5 class="font-heading mb-4" style="color: #FFFF6F6;">NearMe</h5>
                <p class="text-muted" style="color: #6D6D6D !important;">
                    NearMe adalah layanan pemesanan hotel terpercaya yang menawarkan harga terbaik dan akomodasi berkualitas di seluruh Indonesia.
                </p>
                <div class="social-icons mt-3">
                    <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- Kolom Navigasi Cepat -->
            <div class="col-md-2 mb-4">
                <h5 class="font-heading mb-4" style="color: #FFFF6F6;">Navigasi</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="<?= base_url('/') ?>" class="text-decoration-none" style="color: #6D6D6D !important;">Beranda</a></li>
                    <li class="mb-2"><a href="<?= base_url('/hotels') ?>" class="text-decoration-none" style="color: #6D6D6D !important;">Hotel</a></li>
                    <li class="mb-2"><a href="<?= base_url('/about') ?>" class="text-decoration-none" style="color: #6D6D6D !important;">Tentang Kami</a></li>
                    <li class="mb-2"><a href="<?= base_url('/contact') ?>" class="text-decoration-none" style="color: #6D6D6D !important;">Kontak</a></li>
                    <li class="mb-2"><a href="<?= base_url('/faq') ?>" class="text-decoration-none" style="color: #6D6D6D !important;">FAQ</a></li>
                </ul>
            </div>

            <!-- Kolom Kontak -->
            <div class="col-md-3 mb-4">
                <h5 class="font-heading mb-4" style="color: #FFFF6F6;">Hubungi Kami</h5>
                <ul class="list-unstyled" style="color: #6D6D6D !important;">
                    <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Jl. Hotel No.123, Kota, Indonesia</li>
                    <li class="mb-2"><i class="fas fa-phone me-2"></i> +62 812 3456 7890</li>
                    <li class="mb-2"><i class="fas fa-envelope me-2"></i> info@nearme.com</li>
                </ul>
            </div>

            <!-- Kolom Newsletter -->
            <div class="col-md-3 mb-4">
                <h5 class="font-heading mb-4" style="color: #FFFF6F6;">Berlangganan</h5>
                <p class="text-muted" style="color: #6D6D6D !important;">Dapatkan penawaran dan promo menarik langsung ke email Anda.</p>
                <form class="mt-3">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control bg-dark border-secondary" placeholder="Email Anda" style="color: #6D6D6D !important;">
                        <button class="btn btn-primary" type="submit" style="background-color: #FFFF6F6; border-color: #FFFF6F6; color: #1F1F1F;">Langganan</button>
                    </div>
                </form>
            </div>
        </div>

        <hr class="my-4" style="border-color: #454545 !important;">

        <!-- Hak Cipta -->
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0" style="color: #6D6D6D !important;">&copy; <?= date('Y') ?> NearMe. Seluruh hak cipta dilindungi.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item"><a href="#" class="text-decoration-none" style="color: #6D6D6D !important;">Kebijakan Privasi</a></li>
                    <li class="list-inline-item px-2">•</li>
                    <li class="list-inline-item"><a href="#" class="text-decoration-none" style="color: #6D6D6D !important;">Syarat & Ketentuan</a></li>
                    <li class="list-inline-item px-2">•</li>
                    <li class="list-inline-item"><a href="#" class="text-decoration-none" style="color: #6D6D6D !important;">Peta Situs</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
