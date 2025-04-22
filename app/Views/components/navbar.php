<!-- File: app/Views/layout/navbar.php -->
<nav class="navbar navbar-expand-lg" style="background-color: #1F1F1F;">
    <div class="container">
        <!-- Brand Logo -->
        <a class="navbar-brand font-heading" href="<?= base_url('/') ?>" style="color: #0176C8; font-size: 1.5rem;">
            <i class="fas fa-hotel me-2"></i>NearMe
        </a>
        
        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"
                style="border-color: #0176C8;">
            <i class="fas fa-bars" style="color: #0176C8;"></i>
        </button>
        
        <!-- Navbar Items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/') ?>" style="color: #E7E7E7;">
                        <i class="fas fa-home me-1"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/hotels') ?>" style="color: #E7E7E7;">
                        <i class="fas fa-search me-1"></i> Jelajahi Hotel
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false" style="color: #E7E7E7;">
                        <i class="fas fa-map-marker-alt me-1"></i> Destinasi
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: #2D2D2D;">
                        <li><a class="dropdown-item" href="#" style="color: #E7E7E7;">Bali</a></li>
                        <li><a class="dropdown-item" href="#" style="color: #E7E7E7;">Jakarta</a></li>
                        <li><a class="dropdown-item" href="#" style="color: #E7E7E7;">Yogyakarta</a></li>
                        <li><hr class="dropdown-divider" style="border-color: #454545;"></li>
                        <li><a class="dropdown-item" href="#" style="color: #E7E7E7;">Semua Destinasi</a></li>
                    </ul>
                </li>
            </ul>
            
            <!-- Right Side Items -->
            <div class="d-flex align-items-center">
                <?php if (session()->get('logged_in')): ?>
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false" style="color: #E7E7E7;">
                            <button class="btn btn-primary">Info</button>
                            <span class="d-none d-lg-inline"><?= session()->get('full_name') ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown" 
                            style="background-color: #2D2D2D;">
                            <li>
                                <div class="dropdown-header text-center py-2" style="color: #E7E7E7;">
                                    <strong><?= session()->get('full_name') ?></strong><br>
                                    <h5 class=""><?= session()->get('email') ?></h5>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider" style="border-color: #454545;"></li>
                            <li>
                                <a class="dropdown-item" href="<?= base_url('/user/profile') ?>" style="color: #E7E7E7;">
                                    <i class="fas fa-user me-2"></i>Profil Saya
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= base_url('/user/bookings') ?>" style="color: #E7E7E7;">
                                    <i class="fas fa-calendar-alt me-2"></i>Pemesanan
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= base_url('/user/favorites') ?>" style="color: #E7E7E7;">
                                    <i class="fas fa-heart me-2"></i>Favorit
                                </a>
                            </li>
                            <li><hr class="dropdown-divider" style="border-color: #454545;"></li>
                            <li>
                                <a class="dropdown-item" href="<?= base_url('/logout') ?>" style="color: #E7E7E7;">
                                    <i class="fas fa-sign-out-alt me-2"></i>Keluar
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <div class="d-flex">
                        <a href="<?= base_url('/login') ?>" class="btn btn-outline-light me-2" 
                           style="border-color: #0176C8; color: #0176C8;">Masuk</a>
                        <a href="<?= base_url('/signup') ?>" class="btn" 
                           style="background-color: #0176C8; color: #1F1F1F;">Daftar</a>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</nav>