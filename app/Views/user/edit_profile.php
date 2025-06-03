<?= $this->extend('user/profile') ?>

<?= $this->section('profile_content') ?>
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Edit Profil</h5>
    </div>
    <div class="card-body">
        <form action="/user/update-profile" method="post" enctype="multipart/form-data">
            <?php if(session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <?php foreach(session()->getFlashdata('errors') as $error): ?>
                        <p class="mb-1"><?= $error ?></p>
                    <?php endforeach ?>
                </div>
            <?php endif; ?>
            
            <div class="mb-3">
                <label for="full_name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="full_name" name="full_name" 
                       value="<?= old('full_name', $user['full_name']) ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" value="<?= $user['email'] ?>" disabled>
            </div>
            
            <div class="mb-3">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <input type="tel" class="form-control" id="phone" name="phone" 
                       value="<?= old('phone', $user['phone']) ?>">
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Foto Profil</label><br>
                <?php if (!empty($user['photo'])): ?>
                    <img src="<?= base_url('uploads/profiles/' . esc($user['photo'])) ?>" 
                        alt="Foto Profil" width="80" class="rounded mb-2">
                <?php endif; ?>
                <input class="form-control" type="file" id="photo" name="photo" accept="image/*">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengganti.</small>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Simpan Perubahan
            </button>
            <a href="/user/profile" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>