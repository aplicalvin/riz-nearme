<?= $this->extend('templates/header') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-sign-in-alt"></i> Login</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <?= form_open('/login') ?>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt"></i> Masuk
                        </button>
                    </div>
                <?= form_close() ?>

                <hr>
                <p class="text-center">
                    Belum punya akun? <a href="/register">Daftar disini</a>
                </p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>