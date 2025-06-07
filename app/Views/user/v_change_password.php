<?= $this->extend('user/profile') ?>

<?= $this->section('profile_content') ?>
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Ubah Password</h5>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php if (is_array(session()->getFlashdata('errors'))) : ?>
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    <?php else : ?>
                        <?= esc(session()->getFlashdata('errors')) ?>
                    <?php endif; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="<?= route_to('user_submit_change_password') ?>" method="post">
                <div class="mb-3">
                    <label for="current_password" class="form-label">Password Saat Ini</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="current_password" id="current_password" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">Password Baru</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-key"></i></span>
                        <input type="password" name="new_password" id="new_password" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="confirm_new_password" class="form-label">Konfirmasi Password Baru</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                        <input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control" required>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-arrow-repeat me-1"></i> Ubah Password
                    </button>
                </div>
            </form>
        </div>
       
</div>
<?= $this->endSection() ?>
