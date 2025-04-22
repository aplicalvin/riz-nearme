<?= $this->extend('user/profile') ?>

<?= $this->section('profile_content') ?>
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Profil Saya</h5>
    </div>
    <div class="card-body">
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        
        <dl class="row">
            <dt class="col-sm-3">Nama Lengkap</dt>
            <dd class="col-sm-9"><?= esc($user['full_name']) ?></dd>
            
            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9"><?= esc($user['email']) ?></dd>
            
            <dt class="col-sm-3">Nomor Telepon</dt>
            <dd class="col-sm-9"><?= $user['phone'] ? esc($user['phone']) : '-' ?></dd>
            
            <dt class="col-sm-3">Member sejak</dt>
            <dd class="col-sm-9"><?= date('d F Y', strtotime($user['created_at'])) ?></dd>
        </dl>
        
        <a href="/user/edit-profile" class="btn btn-primary">
            <i class="fas fa-edit me-1"></i> Edit Profil
        </a>
    </div>
</div>
<?= $this->endSection() ?>