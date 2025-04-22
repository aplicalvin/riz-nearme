<?php echo $this->extend("layout/layout_utama"); ?>
<?php echo $this->section("konten_utama") ?> 

<div class="auth-container">
    <div class="card shadow-sm">
        <div class="card-body p-5">
            <h2 class="text-center mb-4">Daftar Akun NearMe</h2>
            
            <?php if (session('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach (session('errors') as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <?php if (session('success')): ?>
                <div class="alert alert-success"><?= session('success') ?></div>
            <?php endif; ?>
            
            <form action="<?= base_url('/register') ?>" method="post">
                <div class="mb-3">
                    <label for="full_name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" required>
                </div>
                
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor HP (Opsional)</label>
                    <input type="tel" class="form-control" id="phone" name="phone">
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
                
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">Daftar Sekarang</button>
                </div>
                
                <div class="text-center">
                    <p>Sudah punya akun? <a href="<?= base_url('/login') ?>">Login disini</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?> 