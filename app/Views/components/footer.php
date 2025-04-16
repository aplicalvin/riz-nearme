<!-- Footer -->
<footer class="bg-dark text-white pt-5 pb-4" style="background-color: #1F1F1F !important;">
    <div class="container">
        <div class="row">
            <!-- About Column -->
            <div class="col-md-4 mb-4">
                <h5 class="font-heading mb-4" style="color: #FFFF6F6;">NearMe</h5>
                <p class="text-muted" style="color: #6D6D6D !important;">
                    NearMe provides premium hotel booking services with the best prices and quality accommodations across the country.
                </p>
                <div class="social-icons mt-3">
                    <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- Quick Links Column -->
            <div class="col-md-2 mb-4">
                <h5 class="font-heading mb-4" style="color: #FFFF6F6;">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="<?= base_url('/') ?>" class="text-decoration-none" style="color: #6D6D6D !important;">Home</a></li>
                    <li class="mb-2"><a href="<?= base_url('/hotels') ?>" class="text-decoration-none" style="color: #6D6D6D !important;">Hotels</a></li>
                    <li class="mb-2"><a href="<?= base_url('/about') ?>" class="text-decoration-none" style="color: #6D6D6D !important;">About Us</a></li>
                    <li class="mb-2"><a href="<?= base_url('/contact') ?>" class="text-decoration-none" style="color: #6D6D6D !important;">Contact</a></li>
                    <li class="mb-2"><a href="<?= base_url('/faq') ?>" class="text-decoration-none" style="color: #6D6D6D !important;">FAQ</a></li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div class="col-md-3 mb-4">
                <h5 class="font-heading mb-4" style="color: #FFFF6F6;">Contact Us</h5>
                <ul class="list-unstyled" style="color: #6D6D6D !important;">
                    <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> 123 Hotel St, City, Country</li>
                    <li class="mb-2"><i class="fas fa-phone me-2"></i> +1 234 567 890</li>
                    <li class="mb-2"><i class="fas fa-envelope me-2"></i> info@nearme.com</li>
                </ul>
            </div>

            <!-- Newsletter Column -->
            <div class="col-md-3 mb-4">
                <h5 class="font-heading mb-4" style="color: #FFFF6F6;">Newsletter</h5>
                <p class="text-muted" style="color: #6D6D6D !important;">Subscribe to our newsletter for the latest deals and offers.</p>
                <form class="mt-3">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control bg-dark border-secondary" placeholder="Your Email" style="color: #6D6D6D !important;">
                        <button class="btn btn-primary" type="submit" style="background-color: #FFFF6F6; border-color: #FFFF6F6; color: #1F1F1F;">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>

        <hr class="my-4" style="border-color: #454545 !important;">

        <!-- Copyright Row -->
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0" style="color: #6D6D6D !important;">&copy; <?= date('Y') ?> NearMe. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item"><a href="#" class="text-decoration-none" style="color: #6D6D6D !important;">Privacy Policy</a></li>
                    <li class="list-inline-item px-2">•</li>
                    <li class="list-inline-item"><a href="#" class="text-decoration-none" style="color: #6D6D6D !important;">Terms of Service</a></li>
                    <li class="list-inline-item px-2">•</li>
                    <li class="list-inline-item"><a href="#" class="text-decoration-none" style="color: #6D6D6D !important;">Sitemap</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>