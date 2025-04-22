<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="pagetitle">
    <h1>Manajemen Keluhan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Keluhan</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Keluhan</h5>

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
                                <th scope="col">Tamu</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Isi Keluhan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($complaints as $index => $complaint): ?>
                            <tr>
                                <th scope="row"><?= $index + 1 ?></th>
                                <td><?= esc($complaint['full_name']) ?></td>
                                <td><?= date('d M Y H:i', strtotime($complaint['created_at'])) ?></td>
                                <td><?= esc(substr($complaint['message'], 0, 50)) ?>...</td>
                                <td>
                                    <span class="badge bg-<?= $complaint['status'] == 'open' ? 'warning' : 'success' ?>">
                                        <?= ucfirst($complaint['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" 
                                                data-bs-target="#detailKeluhan<?= $complaint['id'] ?>">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <?php if($complaint['status'] == 'open'): ?>
                                        <form action="<?= base_url('/admin/keluhan/update-status/'.$complaint['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="PUT">
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="bi bi-check-circle"></i> Selesaikan
                                            </button>
                                        </form>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Modal Detail Keluhan -->
                                    <div class="modal fade" id="detailKeluhan<?= $complaint['id'] ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detail Keluhan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Nama Tamu:</strong> <?= esc($complaint['full_name']) ?></p>
                                                    <p><strong>Tanggal:</strong> <?= date('d M Y H:i', strtotime($complaint['created_at'])) ?></p>
                                                    <p><strong>Status:</strong> 
                                                        <span class="badge bg-<?= $complaint['status'] == 'open' ? 'warning' : 'success' ?>">
                                                            <?= ucfirst($complaint['status']) ?>
                                                        </span>
                                                    </p>
                                                    <hr>
                                                    <p><strong>Isi Keluhan:</strong></p>
                                                    <p><?= nl2br(esc($complaint['message'])) ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
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