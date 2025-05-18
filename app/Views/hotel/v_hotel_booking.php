

<!-- Sidebar Pemesanan -->
<div class="col-lg-4">
    <div id="booking-form" class="card border-0 shadow-sm sticky-top" style="top: 20px;">
        <div class="card-body">
            <h3 class="font-heading mb-4">Cek Ketersediaan</h3>
            <form action="<?= base_url('/booking/create') ?>" method="post">
                <input type="hidden" name="hotel_id" value="<?= $hotel['id'] ?>">
                <div class="mb-3">
                    <label class="form-label">Tanggal Check-in</label>
                    <input type="date" name="check_in" class="form-control" required min="<?= date('Y-m-d') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Check-out</label>
                    <input type="date" name="check_out" class="form-control" required min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipe Kamar</label>
                    <select class="form-select" name="room_type_id" required>
                        <option value="">Pilih Tipe Kamar</option>
                        <?php foreach ($room_types as $room): ?>
                        <option value="<?= $room['id'] ?>"><?= esc($room['name']) ?> (<?= number_to_currency($room['base_price'], 'IDR') ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah Kamar</label>
                    <select class="form-select" name="rooms" required>
                        <option value="1" selected>1 Kamar</option>
                        <option value="2">2 Kamar</option>
                        <option value="3">3 Kamar</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100" style="background-color: #0176C8; border-color: #0176C8;">
                    Cek Ketersediaan
                </button>
            </form>
        </div>
    </div>
</div>

