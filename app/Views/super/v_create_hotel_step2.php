<?php echo $this->extend("layout/l_super"); ?>
<?php echo $this->section("content"); ?>

<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h3 class="card-title">Buat Hotel Baru - Step 2</h3>
            <p class="mb-0">Admin Hotel: <strong><?= $admin_name ?></strong></p>
        </div>
        <div class="card-body">
            <form action="<?= base_url('/super/hotel/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="admin_id" value="<?= $admin_id ?>">
                
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Hotel</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                
                <div class="mb-3">
                    <label for="city_id" class="form-label">Kota</label>
                    <select class="form-select" id="city_id" name="city_id" required>
                        <option value="">Pilih Kota</option>
                        <?php foreach ($cities as $city): ?>
                            <option value="<?= $city['id'] ?>"><?= $city['name'] ?> (<?= $city['province'] ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control" id="address" name="address" rows="2" required></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="star_rating" class="form-label">Rating Bintang</label>
                    <select class="form-select" id="star_rating" name="star_rating">
                        <option value="1">★</option>
                        <option value="2">★★</option>
                        <option value="3">★★★</option>
                        <option value="4">★★★★</option>
                        <option value="5">★★★★★</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="cover_photo" class="form-label">Foto Cover</label>
                    <input class="form-control" type="file" id="cover_photo" name="cover_photo">
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('/super/hotel/create') ?>" class="btn btn-secondary">Kembali ke Step 1</a>
                    <button type="submit" class="btn btn-primary">Simpan Hotel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>