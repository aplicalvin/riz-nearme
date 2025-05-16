<?= $this->extend("layout/l_admin") ?>

<?= $this->section("content") ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Kamar</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/rooms/update/' . $room['id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label for="name">Nama Kamar</label>
                    <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" 
                           id="name" name="name" value="<?= old('name', $room['name']) ?>">
                    <?php if (isset($errors['name'])): ?>
                        <div class="invalid-feedback"><?= $errors['name'] ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" 
                              rows="3"><?= old('description', $room['description']) ?></textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="base_price">Harga Dasar (Rp)</label>
                            <input type="number" class="form-control <?= isset($errors['base_price']) ? 'is-invalid' : '' ?>" 
                                   id="base_price" name="base_price" value="<?= old('base_price', $room['base_price']) ?>">
                            <?php if (isset($errors['base_price'])): ?>
                                <div class="invalid-feedback"><?= $errors['base_price'] ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="capacity">Kapasitas (orang)</label>
                            <input type="number" class="form-control <?= isset($errors['capacity']) ? 'is-invalid' : '' ?>" 
                                   id="capacity" name="capacity" value="<?= old('capacity', $room['capacity']) ?>">
                            <?php if (isset($errors['capacity'])): ?>
                                <div class="invalid-feedback"><?= $errors['capacity'] ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="available_rooms">Jumlah Kamar Tersedia</label>
                            <input type="number" class="form-control <?= isset($errors['available_rooms']) ? 'is-invalid' : '' ?>" 
                                   id="available_rooms" name="available_rooms" value="<?= old('available_rooms', $room['available_rooms']) ?>">
                            <?php if (isset($errors['available_rooms'])): ?>
                                <div class="invalid-feedback"><?= $errors['available_rooms'] ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="photo">Foto Kamar</label>
                    <?php if ($room['photo']): ?>
                        <div class="mb-2">
                            <img src="<?= base_url('uploads/rooms/' . $room['photo']) ?>" 
                                 alt="<?= $room['name'] ?>" class="img-thumbnail" style="max-width: 200px;">
                            <p class="text-muted">Foto saat ini</p>
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control-file <?= isset($errors['photo']) ? 'is-invalid' : '' ?>" 
                           id="photo" name="photo">
                    <?php if (isset($errors['photo'])): ?>
                        <div class="invalid-feedback d-block"><?= $errors['photo'] ?></div>
                    <?php endif; ?>
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= base_url('admin/rooms') ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>