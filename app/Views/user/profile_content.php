<?= $this->extend('user/profile') ?>

<?= $this->section('profile_content') ?>

<div class="d-grid gap-2">
    <div class="card shadow-sm text-white p-3" style="background-color: #0176C8;">
        <h5 class="mb-0">Profil Saya</h5>
    </div>
    
    <!-- MyProfile -->
    <div class="card shadow-sm">
        <div class="card-body">
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            
            <div class="row gap-4">
                <div class="col-sm-3">
                    <img src="<?= base_url('uploads/profiles/' . esc($user['photo'])) ?>" alt="<?=$user['full_name']; ?>" class="rounded-4" style="width: 240px; height: 240px; object-fit: cover">
                </div>

                <div class="col-sm-8 ">
                    <div class="row">

                        <dt class="col-sm-3">Nama Lengkap</dt>
                        <dd class="col-sm-9"><?= esc($user['full_name']) ?></dd>
                        
                        <dt class="col-sm-3">Email</dt>
                        <dd class="col-sm-9"><?= esc($user['email']) ?></dd>
                        
                        <dt class="col-sm-3">Nomor Telepon</dt>
                        <dd class="col-sm-9"><?= $user['phone'] ? esc($user['phone']) : '-' ?></dd>
                        
                        <dt class="col-sm-3">Member sejak</dt>
                        <dd class="col-sm-9"><?= date('d F Y', strtotime($user['created_at'])) ?></dd>
                    </div>
                    <a href="/user/edit-profile" class="btn btn-primary">
                        <i class="fas fa-edit me-1"></i> Edit Profil
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</div>

<?= $this->endSection() ?>