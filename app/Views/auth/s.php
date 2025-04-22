
<?php echo $this->extend("layout/layout_utama"); ?>
<?php echo $this->section("konten_utama") ?> 

<div class="auth-container">
    <div class="card shadow-sm">
        <div class="card-body p-5">
            <h2 class="text-center mb-4">Login ke NearMe</h2>
            
            <?php if (session('error')): ?>
                <div class="alert alert-danger"><?= session('error') ?></div>
            <?php endif; ?>
            
            <?php if (session('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach (session('errors') as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <form action="<?= base_url('/login') ?>" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                
                <div class="text-center">
                    <p>Belum punya akun? <a href="<?= base_url('/signup') ?>">Daftar disini</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?> 