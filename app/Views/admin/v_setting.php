<?php echo $this->extend("layout/l_admin"); ?>
<?php echo $this->section("content"); ?>

<div class="container">
    <h1 class="font-heading mb-4">Hotel Settings</h1>

    <?php if (session()->has('message')): ?>
        <div class="alert alert-success"><?= session('message') ?></div>
    <?php endif; ?>
    
    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger"><?= session('error') ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form method="post" action="<?= base_url('admin/setting/update') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nama Hotel</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?= old('name', $datahotel['name'] ?? '') ?>" required>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" 
                                      rows="3"><?= old('description', $datahotel['description'] ?? '') ?></textarea>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="address">Alamat</label>
                            <textarea class="form-control" id="address" name="address" 
                                      rows="2" required><?= old('address', $datahotel['address'] ?? '') ?></textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="star_rating">Rating Bintang</label>
                            <select class="form-control" id="star_rating" name="star_rating">
                                <option value="">Pilih Rating</option>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <option value="<?= $i ?>" <?= (old('star_rating', $datahotel['star_rating'] ?? 0)) == $i ? 'selected' : '' ?>>
                                        <?= str_repeat('★', $i) ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="cover_photo">Foto Utama</label>
                            <input type="file" class="form-control" id="cover_photo" name="cover_photo">
                            
                            <?php if (!empty($datahotel['cover_photo'])): ?>
                                <div class="mt-2">
                                    <img src="<?= base_url('uploads/hotels/' . $datahotel['cover_photo']) ?>" 
                                         alt="Cover Photo" class="img-thumbnail" style="max-height: 150px;">
                                    <p class="text-muted mt-1">Foto saat ini</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>