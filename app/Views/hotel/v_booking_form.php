<?php echo $this->extend("layout/layout_utama"); ?>
<?php echo $this->section("konten_utama") ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Form Pemesanan Kamar</h3>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('booking/create') ?>" method="post">
                        <input type="hidden" name="hotel_id" value="<?= $hotelId ?>">

                        <!-- Informasi Kamar -->
                        <div class="mb-4">
                            <h5 class="mb-3">Informasi Kamar</h5>
                            <div class="form-group">
                                <label for="room_type_id" class="form-label">Tipe Kamar</label>
                                <select class="form-select" id="room_type_id" name="room_type_id" required>
                                    <option value="">Pilih Tipe Kamar</option>
                                    <?php foreach ($roomTypes as $room): ?>
                                        <option value="<?= $room['id'] ?>" 
                                            <?= (isset($selectedRoom) && $selectedRoom['id'] == $room['id']) ? 'selected' : '' ?>
                                            data-price="<?= $room['base_price'] ?>">
                                            <?= esc($room['name']) ?> - <?= number_to_currency($room['base_price'], 'IDR') ?>/malam
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Tanggal Menginap -->
                        <div class="mb-4">
                            <h5 class="mb-3">Tanggal Menginap</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="check_in_date" class="form-label">Check-in</label>
                                        <input type="date" class="form-control" id="check_in_date" name="check_in_date" 
                                            min="<?= date('Y-m-d') ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="check_out_date" class="form-label">Check-out</label>
                                        <input type="date" class="form-control" id="check_out_date" name="check_out_date" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Jumlah Tamu -->
                        <div class="mb-4">
                            <h5 class="mb-3">Jumlah Tamu</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="adults" class="form-label">Dewasa</label>
                                        <input type="number" class="form-control" id="adults" name="adults" min="1" value="1" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="children" class="form-label">Anak-anak (0-12 tahun)</label>
                                        <input type="number" class="form-control" id="children" name="children" min="0" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="mb-4">
                            <h5 class="mb-3">Metode Pembayaran</h5>
                            <div class="form-group">
                                <select class="form-select" id="payment_method_id" name="payment_method_id" required>
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <?php foreach ($paymentMethods as $method): ?>
                                        <option value="<?= $method['id'] ?>"><?= esc($method['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Permintaan Khusus -->
                        <div class="mb-4">
                            <h5 class="mb-3">Permintaan Khusus (Opsional)</h5>
                            <div class="form-group">
                                <textarea class="form-control" id="special_requests" name="special_requests" rows="3" 
                                    placeholder="Contoh: Saya butuh tempat tidur tambahan"></textarea>
                            </div>
                        </div>

                        <!-- Ringkasan Harga -->
                        <div class="mb-4 p-3 bg-light rounded">
                            <h5 class="mb-3">Ringkasan Harga</h5>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Harga Kamar:</span>
                                <span id="room-price">Rp 0</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Jumlah Malam:</span>
                                <span id="nights-count">0 malam</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold">
                                <span>Total Harga:</span>
                                <span id="total-price">Rp 0</span>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Lanjutkan Pemesanan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const roomSelect = document.getElementById('room_type_id');
    const checkInDate = document.getElementById('check_in_date');
    const checkOutDate = document.getElementById('check_out_date');
    const roomPriceSpan = document.getElementById('room-price');
    const nightsCountSpan = document.getElementById('nights-count');
    const totalPriceSpan = document.getElementById('total-price');

    function calculateTotal() {
        const roomPrice = roomSelect.selectedOptions[0]?.dataset.price || 0;
        const checkIn = new Date(checkInDate.value);
        const checkOut = new Date(checkOutDate.value);
        
        if (checkIn && checkOut && checkOut > checkIn) {
            const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
            const total = roomPrice * nights;
            
            roomPriceSpan.textContent = formatCurrency(roomPrice);
            nightsCountSpan.textContent = `${nights} malam`;
            totalPriceSpan.textContent = formatCurrency(total);
        } else {
            roomPriceSpan.textContent = 'Rp 0';
            nightsCountSpan.textContent = '0 malam';
            totalPriceSpan.textContent = 'Rp 0';
        }
    }

    function formatCurrency(amount) {
        return 'Rp ' + parseFloat(amount).toLocaleString('id-ID');
    }

    // Event listeners
    roomSelect.addEventListener('change', calculateTotal);
    checkInDate.addEventListener('change', calculateTotal);
    checkOutDate.addEventListener('change', function() {
        if (checkInDate.value && new Date(this.value) <= new Date(checkInDate.value)) {
            alert('Tanggal check-out harus setelah tanggal check-in');
            this.value = '';
        }
        calculateTotal();
    });

    // Initialize calculation
    calculateTotal();
});
</script>

<?php echo $this->endSection() ?>