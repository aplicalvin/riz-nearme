<?php echo $this->extend("layout/l_admin"); ?>
<?php echo $this->section("content"); ?>

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">Galeri Foto - <?= esc($hotel[0]['name']) ?></h1>
        <a href="<?= base_url('admin/hotels') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>
    
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <!-- Upload Form -->
<div class="card shadow-sm mb-4 border-0">
    <div class="card-header bg-white border-bottom">
        <h5 class="mb-0">Upload Foto Baru</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/gallery/upload/' . $hotel[0]['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <!-- Drop Zone -->
            <div class="upload-zone border border-2 border-dashed rounded-3 p-4 text-center bg-light position-relative"
                ondragover="event.preventDefault();"
                ondrop="handleDrop(event)">
                <div class="mb-2 text-secondary">
                    <i class="fas fa-cloud-upload-alt fa-3x mb-3"></i>
                    <p class="mb-1">Drag and drop files here, or</p>
                    <label for="photo" class="text-primary text-decoration-underline cursor-pointer">browse your computer</label>
                    <p class="text-muted small mb-0">Format: JPG, PNG (maks. 2MB)</p>
                </div>

                <input type="file" name="photo" id="photo" class="d-none" required onchange="previewImage(event)">
            </div>

            <!-- Preview -->
            <div id="preview" class="mt-4 d-none text-center">
                <p class="fw-semibold">Preview:</p>
                <img id="preview-img" src="#" class="img-thumbnail shadow-sm" style="max-height: 200px; object-fit: cover;">
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-upload me-1"></i> Upload
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JS -->
<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const img = document.getElementById('preview-img');
        const file = event.target.files[0];

        if (file) {
            img.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
        }
    }

    function handleDrop(event) {
        event.preventDefault();
        const input = document.getElementById('photo');
        input.files = event.dataTransfer.files;
        previewImage({ target: input });
    }
</script>

<style>
    .upload-zone:hover {
        background-color: #eef4ff;
        cursor: pointer;
    }

    .cursor-pointer {
        cursor: pointer;
    }
</style>

    
    <!-- Gallery Grid -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Daftar Foto</h5>
        </div>
        <div class="card-body">
            <?php if (empty($photos)): ?>
                <div class="alert alert-info">
                    Belum ada foto di galeri ini
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($photos as $photo): ?>
                        <div class="col-md-4 col-lg-3 mb-4">
                            <div class="card h-100">
                                <img src="<?= base_url('uploads/galleries/'.$photo['photo']) ?>" 
                                     class="card-img-top img-fluid" 
                                     style="height: 200px; object-fit: cover;" 
                                     alt="Foto Hotel">
                                <div class="card-body p-2">
                                    <small class="text-muted">
                                        <?= date('d M Y H:i', strtotime($photo['created_at'])) ?>
                                    </small>
                                </div>
                                <div class="card-footer p-2 bg-white">
                                    <form action="<?= base_url('admin/gallery/delete/'.$photo['id']) ?>" method="post" class="d-grid">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus foto ini?')">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>