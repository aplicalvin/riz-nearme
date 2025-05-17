<?= $this->extend("layout/l_admin") ?>

<?= $this->section("content") ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 font-heading"><?= $title ?></h1>

    <?php if (session()->has('message')): ?>
        <div class="alert alert-success"><?= session('message') ?></div>
    <?php endif; ?>
    
    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger"><?= session('error') ?></div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kamar</h6>
            <a href="<?= base_url('admin/rooms/add') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Kamar
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nama Kamar</th>
                            <th>Harga</th>
                            <th>Kapasitas</th>
                            <th>Tersedia</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rooms as $room): ?>
                        <tr>
                            <td>
                                <?php if ($room['photo']): ?>
                                    <img src="<?= base_url('uploads/rooms/' . $room['photo']) ?>" 
                                        alt="<?= $room['name'] ?>" 
                                        class="img-thumbnail" 
                                        style="width: 210px; height: 140px; object-fit: cover;">
                                <?php else: ?>
                                    <span class="text-muted">No photo</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $room['name'] ?></td>
                            <td>Rp <?= number_format($room['base_price'], 0, ',', '.') ?></td>
                            <td><?= $room['capacity'] ?> orang</td>
                            <td><?= $room['available_rooms'] ?> kamar</td>
                            <td>
                                <a href="<?= base_url('admin/rooms/edit/' . $room['id']) ?>" 
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <a href="<?= base_url('admin/rooms/delete/' . $room['id']) ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Yakin menghapus kamar ini?')">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </a>
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