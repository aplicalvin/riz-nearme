<?= $this->extend('user/profile') ?>

<?= $this->section('profile_content') ?>
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">History Pemesanan</h5>
    </div>
    <div class="card-body">
        <?php if(empty($bookings)): ?>
            <div class="alert alert-info">
                Anda belum memiliki riwayat pemesanan
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Booking</th>
                            <th>Hotel</th>
                            <th>Tipe Kamar</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($bookings as $booking): ?>
                        <tr>
                            <td>#<?= $booking['id'] ?></td>
                            <td><?= esc($booking['hotel_name']) ?></td>
                            <td><?= esc($booking['room_type']) ?></td>
                            <td><?= date('d M Y', strtotime($booking['check_in_date'])) ?></td>
                            <td><?= date('d M Y', strtotime($booking['check_out_date'])) ?></td>
                            <td>
                                <span class="badge bg-<?= 
                                    $booking['status'] === 'completed' ? 'success' : 
                                    ($booking['status'] === 'cancelled' ? 'danger' : 'warning') 
                                ?>">
                                    <?= ucfirst($booking['status']) ?>
                                </span>
                            </td>
                            <td>
                                <a href="/booking/<?= $booking['id'] ?>" class="btn btn-sm btn-outline-primary">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        <?php endif ?>
    </div>
</div>
<?= $this->endSection() ?>