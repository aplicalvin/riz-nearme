<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">HotelBooking</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/hotels"><i class="fas fa-hotel me-1"></i> Hotel</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if (session()->get('isLoggedIn')): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> <?= session()->get('full_name') ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/profile"><i class="fas fa-user me-1"></i> Profil</a></li>
                            <li><a class="dropdown-item" href="/bookings"><i class="fas fa-history me-1"></i> Riwayat</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt me-1"></i> Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login"><i class="fas fa-sign-in-alt me-1"></i> Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>