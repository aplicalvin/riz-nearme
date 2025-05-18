<?php echo $this->extend("layout/l_super"); ?>
<?php echo $this->section("content"); ?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="font-heading"><?= $judul ?></h2>
    <div>
        <a href="<?= base_url('super/users/export') ?>" class="btn btn-success me-2">
            <i class="fas fa-file-export"></i> Ekspor
        </a>
        <a href="<?= base_url('super/users/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah User
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



    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Tambahkan di atas tabel -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="get" action="<?= base_url('super/users') ?>" class="">
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <input type="text" class="form-control" style="max-width: 350px;" name="search" placeholder="Cari user..." value="<?= esc($search) ?>">
                            </div>
                            <div class="col-md-2 mb-2">
                                <select class="form-select" name="sort">
                                    <option value="full_name" <?= $sort == 'full_name' ? 'selected' : '' ?>>Nama</option>
                                    <option value="username" <?= $sort == 'username' ? 'selected' : '' ?>>Username</option>
                                    <option value="created_at" <?= $sort == 'created_at' ? 'selected' : '' ?>>Tanggal Daftar</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <select class="form-select" name="order">
                                    <option value="ASC" <?= $order == 'ASC' ? 'selected' : '' ?>>A-Z</option>
                                    <option value="DESC" <?= $order == 'DESC' ? 'selected' : '' ?>>Z-A</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="<?= base_url('super/users') ?>" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                       
                    </form>
                </div>
            </div>
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
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-warning" 
                                            data-bs-toggle="modal" data-bs-target="#resetPasswordModal"
                                            data-user-id="<?= $user['id'] ?>">
                                            Reset Password
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            onclick="confirmDelete('<?= base_url('super/users/delete/' . $user['id']) ?>')">
                                            Hapus 
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
<!-- Tambahkan pagination di bawah tabel -->
<?= $pager->links() ?>
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


<!-- Di bagian bawah file, setelah delete modal -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="resetPasswordModalLabel">Konfirmasi Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin mereset password user ini?</p>
                <p class="fw-bold">Password akan diubah menjadi: <code>password</code></p>
                <div class="alert alert-warning mt-3">
                    <i class="fas fa-exclamation-triangle"></i> User harus mengganti password setelah login!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="#" id="resetPasswordBtn" class="btn btn-warning">Reset Password</a>
            </div>
        </div>
    </div>
</div>

<script>
// Script untuk reset password modal
document.addEventListener('DOMContentLoaded', function() {
    var resetModal = document.getElementById('resetPasswordModal');
    resetModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var userId = button.getAttribute('data-user-id');
        var resetBtn = document.getElementById('resetPasswordBtn');
        resetBtn.href = '/super/users/reset-password/' + userId;
    });
});
</script>

<?php echo $this->endSection() ?>