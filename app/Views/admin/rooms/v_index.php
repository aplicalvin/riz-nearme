<?= $this->extend("layout/l_admin") ?>
<?= $this->section("content") ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 font-heading"><?= $title ?></h1>

    <?php if (session()->has('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session('message') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold"><i class="fas fa-bed me-2"></i>Daftar Kamar</h6>
            <a href="<?= base_url('admin/rooms/add') ?>" class="btn btn-light btn-sm">
                <i class="fas fa-plus-circle me-1"></i> Tambah Kamar
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>Foto</th>
                            <th>Nama Kamar</th>
                            <th>Harga</th>
                            <th>Kapasitas</th>
                            <th>Tersedia</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rooms as $room): ?>
                        <tr>
                            <td class="text-center">
                                <?php if ($room['photo']): ?>
                                    <img src="<?= base_url('uploads/rooms/' . $room['photo']) ?>" 
                                         alt="<?= $room['name'] ?>" 
                                         class="img-thumbnail rounded shadow-sm" 
                                         style="width: 200px; height: 120px; object-fit: cover;">
                                <?php else: ?>
                                    <span class="text-muted fst-italic">No photo</span>
                                <?php endif; ?>
                            </td>
                            <td class="fw-semibold"><?= $room['name'] ?></td>
                            <td><span class="badge bg-success">Rp <?= number_format($room['base_price'], 0, ',', '.') ?></span></td>
                            <td><span class="badge bg-secondary"><?= $room['capacity'] ?> orang</span></td>
                            <td><span class="badge bg-info text-dark"><?= $room['available_rooms'] ?> kamar</span></td>
                            <td class="text-center">
                                <div class="d-grid gap-1">
                                    <a href="<?= base_url('admin/rooms/edit/' . $room['id']) ?>" 
                                       class="btn btn-warning btn-sm" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="<?= base_url('admin/rooms/delete/' . $room['id']) ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Yakin menghapus kamar ini?')" 
                                       title="Hapus">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </a>
                                    <a href="<?= base_url('admin/room-gallery/' . $room['id']) ?>" 
                                       class="btn btn-info btn-sm" 
                                       title="Kelola Galeri">
                                        <i class="fas fa-images"></i> Galeri
                                    </a>
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

<?= $this->endSection() ?>
