<!-- File: app/Views/layout/navbar.php -->
<nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background-color: #ffffff; box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);">
    <div class="container px-3 px-lg-4">
        <!-- Brand Logo -->
        <a class="navbar-brand" href="<?= base_url('/') ?>">
            <div class="d-flex align-items-center">
                <span class="font-heading fw-bold" style="color: #0176C8; font-size: 1.5rem;">NearMe</span>
            </div>
        </a>



        <!-- User Section -->
        <div class="d-flex gap-2 order-lg-3">
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="d-flex align-items-center">
                <?php if (session()->get('logged_in')): ?>
                    <div class="dropdown">
                        <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" 
                            id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= view_cell('\App\Cells\UserCell::photo') ?>" 
                                class="rounded-circle me-2" width="36" height="36" alt="User">
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm" aria-labelledby="userDropdown">
                            <li class="px-3 py-2">
                                <div class="d-flex align-items-center">
                                    <img src="<?= view_cell('\App\Cells\UserCell::photo') ?>" 
                                        class="rounded-circle me-2" width="48" height="48" alt="User">
                                    <div>
                                        <h6 class="mb-0"><?= view_cell('\App\Cells\UserCell::fullName') ?></h6>
                                        <small class="text-muted"><?= view_cell('\App\Cells\UserCell::email') ?></small>
                                    </div>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            
                            <?php if(session()->get('role') == 'user'): ?>
                                <li><a class="dropdown-item" href="<?= base_url('/user/profile') ?>"><i class="fas fa-user-circle me-2"></i> Profil Saya</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('/user/bookings') ?>"><i class="fas fa-calendar-check me-2"></i> Pemesanan</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('/user/favorites') ?>"><i class="fas fa-heart me-2"></i> Favorit</a></li>
                            <?php elseif(session()->get('role') == 'hotel'): ?>
                                <li><a class="dropdown-item" href="<?= base_url('/admin') ?>"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('/admin/booking') ?>"><i class="fas fa-receipt me-2"></i> Manajemen Booking</a></li>
                            <?php elseif(session()->get('role') == 'admin'): ?>
                                <li><a class="dropdown-item" href="<?= base_url('/super') ?>"><i class="fas fa-crown me-2"></i> Super Admin</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('/super/users') ?>"><i class="fas fa-users-cog me-2"></i> Manajemen User</a></li>
                            <?php endif; ?>
                            
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" href="#"><i class="fas fa-sign-out-alt me-2"></i> Keluar</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <div class="d-flex">
                        <a href="<?= base_url('/login') ?>" class="btn btn-outline-primary me-2 px-3">
                            <i class="fas fa-sign-in-alt me-1"></i> Masuk
                        </a>
                        <a href="<?= base_url('/register') ?>" class="btn btn-primary px-3">
                            <i class="fas fa-user-plus me-1"></i> Daftar
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>


                <!-- Navbar Content - Moved up for desktop view -->
        <div class="collapse navbar-collapse order-lg-2" id="navbarContent">
            <ul class="navbar-nav mx-auto">
                <!-- Main Navigation -->
                <li class="nav-item mx-2">
                    <a class="nav-link" href="<?= base_url('/hotels') ?>" style="color: #333;">
                        <i class="fas fa-search me-1"></i> Cari Hotel
                    </a>
                </li>
                
                <li class="nav-item dropdown mx-2">
                    <a class="nav-link dropdown-toggle" href="#" id="destinationsDropdown" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false" style="color: #333;">
                        <i class="fas fa-map-marker-alt me-1"></i> Destinasi
                    </a>
                    <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="destinationsDropdown">
                        <li><h6 class="dropdown-header text-primary">Destinasi Populer</h6></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-umbrella-beach me-2"></i> Bali</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-city me-2"></i> Jakarta</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-mountain me-2"></i> Yogyakarta</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-globe-asia me-2"></i> Semua Destinasi</a></li>
                    </ul>
                </li>
                
                <!-- <li class="nav-item mx-2">
                    <a class="nav-link" href="#" style="color: #333;">
                        <i class="fas fa-percentage me-1"></i> Promo
                    </a>
                </li> -->
            </ul>
        </div>
    </div>
</nav>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true" >
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin keluar dari sistem?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="/logout" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
</div>

<style>
    /* Navbar Styling */
    .navbar {
        transition: all 0.3s ease;
    }
    
    /* Nav Link Styling */
    .nav-link {
        color: #333;
        font-weight: 500;
        padding: 0.5rem 1rem;
        position: relative;
    }
    
    .nav-link:hover {
        color: #0176C8;
    }
    
    .nav-link.active {
        color: #0176C8;
    }
    
    /* Dropdown Styling */
    .dropdown-menu {
        border-radius: 0.5rem;
        padding: 0.5rem 0;
    }
    
    .dropdown-item {
        padding: 0.5rem 1.5rem;
        font-weight: 400;
    }
    
    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #0176C8;
    }
    
    /* User Dropdown */
    .dropdown-header {
        font-size: 0.875rem;
    }

    /* Order classes for responsive layout */
    @media (min-width: 992px) {
        .navbar-brand {
            order: 1;
        }
        .navbar-collapse {
            order: 2;
        }
        .d-flex.gap-2 {
            order: 3;
        }
    }
</style>