<?= $this->extend('templates/header') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <img src="/uploads/profiles/<?= esc($user['photo'] ?? 'default.jpg') ?>" 
                     class="rounded-circle mb-3" 
                     width="150" 
                     height="150"
                     alt="Foto Profil">
                <h4><?= esc($user['full_name']) ?></h4>
                <p class="text-muted">Member sejak <?= date('d M Y', strtotime($user['created_at'])) ?></p>
                <a href="/profile/edit" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> Edit Profil
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-info-circle"></i> Informasi Akun</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6>Username</h6>
                        <p><?= esc($user['username']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <h6>Email</h6>
                        <p><?= esc($user['email']) ?></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6>Nomor Telepon</h6>
                        <p><?= esc($user['phone'] ?? 'Belum diisi') ?></p>
                    </div>
                    <div class="col-md-6">
                        <h6>Role</h6>
                        <p><?= ucfirst($user['role']) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>