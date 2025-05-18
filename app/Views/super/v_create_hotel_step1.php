<?php echo $this->extend("layout/l_super"); ?>
<?php echo $this->section("content"); ?>

<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h3 class="card-title">Buat Admin Hotel Baru - Step 1</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('/super/hotel/store-admin') ?>" method="post">
                <?= csrf_field() ?>
                
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
                    <label for="phone" class="form-label">No. Telepon</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('/super/hotel') ?>" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Lanjut ke Step 2</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>