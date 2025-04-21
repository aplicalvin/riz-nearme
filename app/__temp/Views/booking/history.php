<?= $this->extend('templates/header') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0"><i class="fas fa-history"></i> Riwayat Pemesanan</h4>
    </div>
    <div class="card-body">
        <?php if (empty($bookings)): ?>
            <div class="alert alert-info">Anda belum memiliki riwayat pemesanan</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID Booking</th>
                            <th>Hotel</th>
                            <th>Kamar</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td>#<?= $booking['id'] ?></td>
                            <td><?= esc($booking['hotel_name']) ?></td>
                            <td><?= esc($booking['room_name']) ?></td>
                            <td>
                                <?= date('d M Y', strtotime($booking['check_in_date'])) ?><br>
                                s/d <?= date('d M Y', strtotime($booking['check_out_date'])) ?>
                            </td>
                            <td>Rp <?= number_format($booking['total_price'], 0, ',', '.') ?></td>
                            <td>
                                <?php 
                                $badgeClass = [
                                    'pending' => 'bg-warning',
                                    'confirmed' => 'bg-success',
                                    'cancelled' => 'bg-danger',
                                    'completed' => 'bg-info'
                                ];
                                ?>
                                <span class="badge <?= $badgeClass[$booking['status']] ?>">
                                    <?= ucfirst($booking['status']) ?>
                                </span>
                            </td>
                            <td>
                                <a href="/bookings/<?= $booking['id'] ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>