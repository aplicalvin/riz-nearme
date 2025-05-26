<?php echo $this->extend('layout/l_super'); ?>
<?php echo $this->section('content'); ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <div>
            <a href="<?= base_url('super/cities/create') ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Kota
            </a>
        </div>
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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kota</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <form method="get" action="<?= base_url('super/cities') ?>">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" placeholder="Cari kota..." value="<?= esc($keyword ?? '') ?>">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="fas fa-search"></i>
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kota</th>
                            <th>Provinsi</th>
                            <th>Jumlah Hotel</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cities as $index => $city): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= esc($city['name']) ?></td>
                            <td><?= esc($city['province']) ?></td>
                            <td><?= $city['hotel_count'] ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?= base_url('super/cities/edit/'.$city['id']) ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            onclick="confirmDelete('<?= base_url('super/cities/delete/'.$city['id']) ?>')">
                                        <i class="fas fa-trash"></i> Delete
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

<script>
function confirmDelete(url) {
    if (confirm('Apakah Anda yakin ingin menghapus kota ini?')) {
        window.location.href = url;
    }
}
</script>

<?php echo $this->endSection(); ?>