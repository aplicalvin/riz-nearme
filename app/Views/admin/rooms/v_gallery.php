<?= $this->extend('layout/l_admin') ?>
<?= $this->section('content') ?>

<h1 class="h3 mb-4"><?= $title ?></h1>

<form action="<?= base_url('admin/room-gallery/upload/' . $room['id']) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="form-group">
        <label>Upload Foto Galeri</label>
        <input type="file" name="photo" class="form-control <?= isset($errors['photo']) ? 'is-invalid' : '' ?>">
        <?php if (isset($errors['photo'])): ?>
            <div class="invalid-feedback"><?= $errors['photo'] ?></div>
        <?php endif ?>
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
</form>

<hr>

<div class="row mt-3">
    <?php foreach ($photos as $p): ?>
        <div class="col-md-3 mb-3">
            <div class="card">
                <img src="<?= base_url('uploads/room_gallery/' . $p['photo']) ?>" class="card-img-top">
                <div class="card-body text-center">
                    <a href="<?= base_url('admin/room-gallery/delete/' . $p['id']) ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Hapus foto ini?')">Hapus</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>
