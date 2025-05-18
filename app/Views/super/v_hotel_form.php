<?php echo $this->extend("layout/l_super"); ?>
<?php echo $this->section("content"); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h3 class="card-title mb-0"><?= $judul ?></h3>
                </div>
                <div class="card-body">
                    <?php if (isset($validation)): ?>
                        <div class="alert alert-danger">
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="<?= isset($hotel) ? base_url('super/hotel/update/' . $hotel['id']) : base_url('super/hotel/store') ?>" enctype="multipart/form-data">
                        <?php if (isset($hotel)): ?>
                            <input type="hidden" name="id" value="<?= $hotel['id'] ?>">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Hotel</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?= old('name', $hotel['name'] ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required><?= old('description', $hotel['description'] ?? '') ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="city_id" class="form-label">Kota</label>
                                <input type="text" class="form-control" id="city_id" name="city_id" 
                                       value="<?= old('city_id', $hotel['city_id'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="star_rating" class="form-label">Rating Bintang (1-5)</label>
                                <select class="form-select" id="star_rating" name="star_rating">
                                    <option value="">Pilih rating</option>
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <option value="<?= $i ?>" <?= (old('star_rating', $hotel['star_rating'] ?? '')) == $i ? 'selected' : '' ?>>
                                            <?= str_repeat('★', $i) ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" id="address" name="address" rows="2" required><?= old('address', $hotel['address'] ?? '') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="admin_id" class="form-label">Admin Hotel</label>
                            <select class="form-select" id="admin_id" name="admin_id">
                                <option value="">Pilih Admin</option>
                                <?php foreach ($admin_options as $admin): ?>
                                    <option value="<?= $admin['id'] ?>" <?= (old('admin_id', $hotel['admin_id'] ?? '')) == $admin['id'] ? 'selected' : '' ?>>
                                        <?= $admin['full_name'] ?> (<?= $admin['email'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="cover_photo" class="form-label">Foto Cover</label>
                            <input class="form-control" type="file" id="cover_photo" name="cover_photo">
                            <?php if (isset($hotel) && $hotel['cover_photo']): ?>
                                <div class="mt-2">
                                    <img src="<?= base_url('uploads/hotels/' . $hotel['cover_photo']) ?>" 
                                         alt="Current Cover" 
                                         class="img-thumbnail" 
                                         width="150">
                                    <input type="hidden" name="old_cover_photo" value="<?= $hotel['cover_photo'] ?>">
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('super/hotel') ?>" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>