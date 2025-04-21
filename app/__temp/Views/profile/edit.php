<?= $this->extend('templates/header') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-user-edit"></i> Edit Profil</h5>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <?= form_open_multipart('/profile/update') ?>
                    <div class="mb-3 text-center">
                        <img src="/uploads/profiles/<?= esc($user['photo'] ?? 'default.jpg') ?>" 
                             class="rounded-circle mb-2" 
                             width="120" 
                             height="120"
                             alt="Foto Profil">
                        <input type="file" name="photo" class="form-control mt-2" accept="image/*">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="full_name" class="form-control" 
                                   value="<?= esc($user['full_name']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="tel" name="phone" class="form-control" 
                                   value="<?= esc($user['phone'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" 
                               value="<?= esc($user['email']) ?>" disabled>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>