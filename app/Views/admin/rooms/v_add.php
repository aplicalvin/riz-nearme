<?= $this->extend("layout/l_admin") ?>
<?= $this->section("content") ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 font-heading"><?= $title ?></h1>

    <div class="card shadow-lg mb-4">
        <div class="card-header bg-primary text-white">
            <h6 class="m-0 fw-bold"><i class="fas fa-plus-circle me-2"></i>Form Tambah Kamar</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/rooms/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Kamar</label>
                    <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" 
                           id="name" name="name" value="<?= old('name') ?>" placeholder="Contoh: Deluxe Room">
                    <?php if (isset($errors['name'])): ?>
                        <div class="invalid-feedback"><?= $errors['name'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" 
                              rows="4" placeholder="Tuliskan deskripsi lengkap tentang kamar..."><?= old('description') ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="base_price" class="form-label">Harga Dasar (Rp)</label>
                        <input type="number" class="form-control <?= isset($errors['base_price']) ? 'is-invalid' : '' ?>" 
                               id="base_price" name="base_price" value="<?= old('base_price') ?>" placeholder="Misal: 350000">
                        <?php if (isset($errors['base_price'])): ?>
                            <div class="invalid-feedback"><?= $errors['base_price'] ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="capacity" class="form-label">Kapasitas (orang)</label>
                        <input type="number" class="form-control <?= isset($errors['capacity']) ? 'is-invalid' : '' ?>" 
                               id="capacity" name="capacity" value="<?= old('capacity') ?>" placeholder="Misal: 2">
                        <?php if (isset($errors['capacity'])): ?>
                            <div class="invalid-feedback"><?= $errors['capacity'] ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="available_rooms" class="form-label">Jumlah Kamar Tersedia</label>
                        <input type="number" class="form-control <?= isset($errors['available_rooms']) ? 'is-invalid' : '' ?>" 
                               id="available_rooms" name="available_rooms" value="<?= old('available_rooms') ?>" placeholder="Misal: 5">
                        <?php if (isset($errors['available_rooms'])): ?>
                            <div class="invalid-feedback"><?= $errors['available_rooms'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="photo" class="form-label">Foto Kamar</label>
                    <input type="file" class="form-control <?= isset($errors['photo']) ? 'is-invalid' : '' ?>" 
                           id="photo" name="photo" accept="image/*">
                    <?php if (isset($errors['photo'])): ?>
                        <div class="invalid-feedback d-block"><?= $errors['photo'] ?></div>
                    <?php endif; ?>
                    <div class="form-text">Format yang didukung: jpg, png, jpeg. Maks 2MB.</div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="<?= base_url('admin/rooms') ?>" class="btn btn-secondary me-2">
                        <i class="fas fa-arrow-left"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
