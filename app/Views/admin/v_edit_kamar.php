<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="pagetitle">
    <h1><?= isset($room) ? 'Edit' : 'Tambah' ?> Kamar</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/admin') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('/admin/kamar') ?>">Kamar</a></li>
            <li class="breadcrumb-item active"><?= isset($room) ? 'Edit' : 'Tambah' ?></li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Kamar</h5>

                    <?php if(isset($validation)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach($validation->getErrors() as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?= isset($room) ? base_url('/admin/kamar/update/'.$room['id']) : base_url('/admin/kamar/simpan') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <?php if(isset($room)): ?>
                            <input type="hidden" name="_method" value="PUT">
                        <?php endif; ?>

                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Nama Tipe Kamar</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" 
                                       value="<?= old('name', $room['name'] ?? '') ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="base_price" class="col-sm-2 col-form-label">Harga Dasar</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" id="base_price" name="base_price" 
                                           value="<?= old('base_price', $room['base_price'] ?? '') ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="capacity" class="col-sm-2 col-form-label">Kapasitas</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="number" class="form-control" id="capacity" name="capacity" 
                                           value="<?= old('capacity', $room['capacity'] ?? '') ?>" required>
                                    <span class="input-group-text">Orang</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="available_rooms" class="col-sm-2 col-form-label">Jumlah Kamar</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="available_rooms" name="available_rooms" 
                                       value="<?= old('available_rooms', $room['available_rooms'] ?? '') ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="description" name="description" 
                                          rows="3" required><?= old('description', $room['description'] ?? '') ?></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="photo" class="col-sm-2 col-form-label">Foto Kamar</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="photo" name="photo">
                                <?php if(isset($room) && $room['photo']): ?>
                                    <div class="mt-2">
                                        <img src="<?= base_url('uploads/rooms/'.$room['photo']) ?>" 
                                             alt="Current Photo" 
                                             style="max-width: 200px; max-height: 150px;">
                                        <p class="text-muted mt-1">Foto saat ini</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('/admin/kamar') ?>" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>