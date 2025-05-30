<?php echo $this->extend("layout/l_admin"); ?>
<?php echo $this->section("content"); ?>

<div class="container-fluid">
    <div class="mb-3">
        <h5 class="m-0 fw-bold font-heading"><i class="fas fa-cogs me-2"></i>Form Pengaturan Hotel</h5>
    </div>


    <?php if (session()->has('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session('message') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    <?php endif; ?>
    
    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <!-- <div class="card-header bg-primary text-white mb-3">
            <h6 class="m-0 fw-bold"><i class="fas fa-cogs me-2"></i>Form Pengaturan Hotel</h6>
        </div> -->

        <div class="card-body mt-3">
            <form method="post" action="<?= base_url('admin/setting/update') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row">
                    <!-- Kiri -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Hotel</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?= old('name', $datahotel['name'] ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" 
                                      rows="3" placeholder="Ceritakan tentang hotel Anda..."><?= old('description', $datahotel['description'] ?? '') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control" id="address" name="address" 
                                      rows="2" required><?= old('address', $datahotel['address'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <!-- Kanan -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="star_rating" class="form-label">Rating Bintang</label>
                            <select class="form-control" id="star_rating" name="star_rating">
                                <option value="">Pilih Rating</option>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <option value="<?= $i ?>" <?= (old('star_rating', $datahotel['star_rating'] ?? 0)) == $i ? 'selected' : '' ?>>
                                        <?= str_repeat('★', $i) ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="cover_photo" class="form-label">Foto Utama</label>
                            <input type="file" class="form-control" id="cover_photo" name="cover_photo" accept="image/*">
                            
                            <?php if (!empty($datahotel['cover_photo'])): ?>
                                <div class="mt-3">
                                    <img src="<?= base_url('uploads/hotels/' . $datahotel['cover_photo']) ?>" 
                                         alt="Foto Saat Ini" class="img-thumbnail" style="max-height: 150px;">
                                    <p class="text-muted mt-1 mb-0">Foto saat ini</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>
