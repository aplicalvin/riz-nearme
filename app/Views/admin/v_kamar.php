<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="pagetitle">
    <h1>Manajemen Kamar</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Kamar</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Daftar Kamar</h5>
                        <a href="<?= base_url('/admin/kamar/tambah') ?>" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Kamar
                        </a>
                    </div>

                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Tipe Kamar</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Kapasitas</th>
                                <th scope="col">Tersedia</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($rooms as $index => $room): ?>
                            <tr>
                                <th scope="row"><?= $index + 1 ?></th>
                                <td>
                                    <img src="<?= !empty($room['photo']) ? base_url('uploads/rooms/'.$room['photo']) : base_url('assets/img/no-image.jpg') ?>" 
                                         alt="<?= esc($room['name']) ?>" 
                                         style="width: 80px; height: 60px; object-fit: cover;">
                                </td>
                                <td><?= esc($room['name']) ?></td>
                                <td><?= number_to_currency($room['base_price'], 'IDR') ?></td>
                                <td><?= $room['capacity'] ?> Orang</td>
                                <td><?= $room['available_rooms'] ?> Kamar</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('/admin/kamar/edit/'.$room['id']) ?>" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="<?= base_url('/admin/kamar/hapus/'.$room['id']) ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
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
</section>
<?= $this->endSection() ?>