<!-- resources/views/booking_form.php -->
<form action="/bookings/store" method="post">
    <input type="hidden" name="hotel_id" value="<?= $hotelId ?>">
    <select name="room_type_id">
        <?php foreach($roomTypes as $room): ?>
            <option value="<?= $room['id'] ?>">
                <?= $room['name'] ?> - Rp <?= number_format($room['base_price']) ?>
            </option>
        <?php endforeach ?>
    </select>
    <!-- Tambahkan field lainnya -->
</form>