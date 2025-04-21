<?= $this->extend('templates/header') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-calendar-check"></i> Form Pemesanan</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <h5 class="mb-3"><?= esc($room['name']) ?></h5>
                <p class="text-success fw-bold">Rp <?= number_format($room['base_price'], 0, ',', '.') ?>/malam</p>
                <hr>

                <?= form_open('/bookings') ?>
                    <input type="hidden" name="room_id" value="<?= $room['id'] ?>">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Check-in</label>
                            <input type="date" name="check_in" class="form-control" required
                                   min="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Check-out</label>
                            <input type="date" name="check_out" class="form-control" required
                                   min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Dewasa</label>
                            <select name="adults" class="form-select" required>
                                <?php for ($i = 1; $i <= $room['capacity']; $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?> orang</option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Anak-anak</label>
                            <select name="children" class="form-select">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select name="payment_method" class="form-select" required>
                            <?php foreach ($paymentMethods as $method): ?>
                                <option value="<?= $method['id'] ?>">
                                    <?= esc($method['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan Khusus</label>
                        <textarea name="notes" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-check-circle"></i> Konfirmasi Pemesanan
                        </button>
                    </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>