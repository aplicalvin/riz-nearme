<?= $this->extend('layout/layout_utama') ?>

<?= $this->section('konten_utama') ?>
<div class="container py-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card shadow-sm rounded-4 d-grid">
                <!-- Identitas -->
                <div class="card-body text-center">
                    <i class="fas fa-user-circle fa-5x mb-3" style="color: #0176C8;"></i>
                    <h5><?= esc($user['full_name']) ?></h5>
                    <p class="text-muted"><?= esc($user['email']) ?></p>
                </div>
                <!-- Identitas END -->
                
                <!-- Menu -->
                <ul class="list-group list-group-flush">
                    <a href="/user/profile" class="list-group-item list-group-item-action <?= $activeTab === 'profile' ? 'active' : '' ?>">
                        <i class="fas fa-user me-2"></i> Profil Saya
                    </a>
                    <a href="/user/bookings" class="list-group-item list-group-item-action <?= $activeTab === 'bookings' ? 'active' : '' ?>">
                        <i class="fas fa-calendar-alt me-2"></i> Pemesanan
                    </a>
                    <a href="/user/favorites" class="list-group-item list-group-item-action <?= $activeTab === 'favorites' ? 'active' : '' ?>">
                        Favorit
                    </a>
                </ul>
                
                <ul class="list-group list-group-flush my-3 mx-2">
                    <a href="/logout" class="btn  text-white  <?= $activeTab === 'favorites' ? 'active' : '' ?>" style="background-color: #DB2623;">
                        Logout
                    </a>
                </ul>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-9">
            <?= $this->renderSection('profile_content') ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>