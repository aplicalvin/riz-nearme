<?php echo $this->extend("layout/l_super"); ?>
<?php echo $this->section("content"); ?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="font-heading"><?= $judul ?></h2>
        <a href="<?= base_url('super/users/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah User
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
                            <th>User</th>
                            <th>Kontak</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $index => $user): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <?php if ($user['photo']): ?>
                                    <img src="<?= base_url('uploads/profiles/' . $user['photo']) ?>" 
                                         alt="<?= $user['full_name'] ?>" 
                                         class="rounded-circle me-3" 
                                         width="40" height="40" style="object-fit: cover">
                                    <?php endif; ?>
                                    <div>
                                        <h6 class="mb-0"><?= $user['full_name'] ?></h6>
                                        <small class="text-muted">@<?= $user['username'] ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div><?= $user['email'] ?></div>
                                <small class="text-muted"><?= $user['phone'] ?></small>
                            </td>
                            <td><?= date('d M Y', strtotime($user['created_at'])) ?></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                        onclick="confirmDelete('<?= base_url('super/users/delete/' . $user['id']) ?>')">
                                    Hapus
                                </button>
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
    if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
        window.location.href = url;
    }
}
</script>

<?php echo $this->endSection() ?>