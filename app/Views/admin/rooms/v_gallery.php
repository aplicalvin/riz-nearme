<?= $this->extend('layout/l_admin') ?>
<?= $this->section('content') ?>

<h1 class="h3 mb-4 font-heading fw-semibold"><?= $title ?></h1>

<!-- Upload Form -->
<div class="card shadow-sm mb-4 border-0">
  <div class="card-body">
    <form action="<?= base_url('admin/room-gallery/upload/' . $room['id']) ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>

      <label for="photo" class="form-label fw-semibold mb-2">Upload Foto Galeri</label>

      <!-- Drop Zone -->
      <div class="upload-zone border border-2 border-dashed rounded-3 p-4 text-center bg-light position-relative" 
           ondragover="event.preventDefault();" 
           ondrop="handleDrop(event)">
        <div class="mb-2 text-secondary">
          <i class="fas fa-cloud-upload-alt fa-3x mb-3"></i>
          <p class="mb-1">Drag and drop files here, or</p>
          <label for="photo" class="text-primary text-decoration-underline cursor-pointer">browse your computer</label>
        </div>

        <input type="file" name="photo" id="photo" class="d-none" onchange="previewImage(event)">
      </div>

      <?php if (isset($errors['photo'])): ?>
        <div class="text-danger small mt-2"><?= $errors['photo'] ?></div>
      <?php endif ?>

      <!-- Preview -->
      <div id="preview" class="mt-4 d-none text-center">
        <p class="fw-semibold">Preview:</p>
        <img id="preview-img" src="#" class="img-thumbnail shadow-sm" style="max-height: 200px; object-fit: cover;">
      </div>

      <div class="text-end mt-4">
        <button type="submit" class="btn btn-success px-4">
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
</style>



<!-- Gallery -->
<div class="row">
    <?php if (empty($photos)): ?>
        <div class="col-12">
            <div class="alert alert-info text-center">
                Belum ada foto yang diunggah untuk kamar ini.
            </div>
        </div>
    <?php else: ?>
        <?php foreach ($photos as $p): ?>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="<?= base_url('uploads/room_gallery/' . $p['photo']) ?>" 
                         class="card-img-top rounded-top" 
                         alt="Foto Kamar" style="height: 180px; object-fit: cover;">
                    <div class="card-body text-center">
                        <a href="<?= base_url('admin/room-gallery/delete/' . $p['id']) ?>" 
                           class="btn btn-sm btn-outline-danger"
                           onclick="return confirm('Hapus foto ini?')">
                            <i class="fas fa-trash-alt me-1"></i> Hapus
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>


<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('preview');
    const previewImg = document.getElementById('preview-img');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('d-none');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<?= $this->endSection() ?>
