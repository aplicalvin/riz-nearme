<?php echo $this->extend('layout/l_super'); ?>
<?php echo $this->section('content'); ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <?php if (isset($validation)): ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <?php if (session('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= isset($city) ? base_url('super/cities/update/'.$city['id']) : base_url('super/cities/store') ?>" method="post">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Kota</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="<?= old('name', $city['name'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="province" class="form-label">Provinsi</label>
                    <input type="text" class="form-control" id="province" name="province" 
                           value="<?= old('province', $city['province'] ?? '') ?>" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('super/cities') ?>" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>