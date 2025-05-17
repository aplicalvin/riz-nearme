<?php echo $this->extend("layout/l_super"); ?>
<?php echo $this->section("content"); ?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="font-heading"><?= $judul ?></h2>
        <a href="<?= base_url('super/hotel/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Hotel
        </a>
    </div>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Hotel</th>
                            <th>Lokasi</th>
                            <th>Bintang</th>
                            <th>Admin</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($hotels as $index => $hotel): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <?php if ($hotel['cover_photo']): ?>
                                    <img src="<?= base_url('uploads/hotels/' . $hotel['cover_photo']) ?>" 
                                         alt="<?= $hotel['name'] ?>" 
                                         class="rounded me-3" 
                                         width="50" height="50" style="object-fit: cover">
                                    <?php endif; ?>
                                    <div>
                                        <h6 class="mb-0"><?= $hotel['name'] ?></h6>
                                        <small class="text-muted"><?= character_limiter($hotel['description'], 50, '...') ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?= $hotel['city_name'] ?><br>
                                <small class="text-muted"><?= $hotel['address'] ?></small>
                            </td>
                            <td>
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                    <i class="fas fa-star <?= $i < $hotel['star_rating'] ? 'text-warning' : 'text-secondary' ?>"></i>
                                <?php endfor; ?>
                            </td>
                            <td><?= $hotel['admin_name'] ?? 'Belum ada admin' ?></td>
                            <td><?= date('d M Y', strtotime($hotel['created_at'])) ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?= base_url('super/hotel/edit/' . $hotel['id']) ?>" class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>
                    
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            data-hotel-id="<?= $hotel['id'] ?>">
                                            Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Di bagian bawah file v_hotel.php -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus hotel ini?</p>
                <p class="fw-bold">Ini juga akan menghapus:</p>
                <ul>
                    <li>Admin hotel terkait</li>
                    <li>Semua tipe kamar di hotel ini</li>
                    <li>Foto-foto terkait</li>
                </ul>
                <p class="text-danger">Aksi ini tidak dapat dibatalkan!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="#" id="deleteButton" class="btn btn-danger">Hapus</a>
            </div>

        </div>
    </div>
</div>

<script>
// Script untuk modal konfirmasi
document.addEventListener('DOMContentLoaded', function() {
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var hotelId = button.getAttribute('data-hotel-id');
        var deleteButton = document.getElementById('deleteButton');
        deleteButton.href = '/super/hotel/delete/' + hotelId;
    });
});
</script>

<script>
function confirmDelete(url) {
    if (confirm('Apakah Anda yakin ingin menghapus hotel ini?')) {
        window.location.href = url;
    }
}
</script>

<?php echo $this->endSection() ?>