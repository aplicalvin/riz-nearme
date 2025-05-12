<?= $this->extend('user/profile') ?>

<?= $this->section('profile_content') ?>
<div class="d-grid gap-2">
    <div class="card shadow-sm text-white p-3" style="background-color: #0176C8;">
        <h5 class="mb-0">Hotel Favorit</h5>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <?php if(empty($favorites)): ?>
                <div class="alert alert-info">
                    Anda belum menambahkan hotel favorit
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach($favorites as $fav): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="<?= base_url('uploads/hotels/' . $fav['cover_photo']) ?>" 
                                 class="card-img-top" alt="<?= esc($fav['name']) ?>" style="height: 150px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?= esc($fav['name']) ?></h5>
                                <div class="mb-2">
                                    <?php for($i = 0; $i < $fav['star_rating']; $i++): ?>
                                        <i class="fas fa-star text-warning"></i>
                                    <?php endfor ?>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="/hotels/<?= $fav['hotel_id'] ?>" class="btn btn-sm btn-primary">
                                    Lihat Detail
                                </a>
                                <a href="/hotels/<?= $fav['hotel_id'] ?>/favorite" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-heart-broken"></i> Hapus
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>