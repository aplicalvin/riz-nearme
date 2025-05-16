<?php echo $this->extend("layout/l_admin"); ?>
<?php echo $this->section("content"); ?>

<h1 class="font-heading">Booking</h1>

    <!-- TABLE -->
    <div class="card">
    <div class="card-body">
        <h5 class="card-title">Datatables</h5>
        <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>
                    <!-- Tambahkan ini untuk menampilkan flash message -->
            <?php if (session()->has('message')) : ?>
                <div class="alert alert-success"><?= session('message') ?></div>
            <?php endif; ?>

            <?php if (session()->has('error')) : ?>
                <div class="alert alert-danger"><?= session('error') ?></div>
            <?php endif; ?>
        <!-- Table with stripped rows -->
        <table class="table datatable">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Pelanggan</th>
            <th scope="col">Tipe Kamar</th>
            <th scope="col">Pembayaran</th>
            <th scope="col">Check In</th>
            <th scope="col">Check Out</th>
            <th scope="col">Total Harga</th>
            <th scope="col">Status</th>
            <th scope="col">Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($bookings as $book): ?>
                <tr>
                    <th scope="row">1</th>
                    <td>
                        <p><?= $book['guest_name'] ?></p>
                        <p><?= $book['guest_email'] ?></p>
                        <p><?= $book['guest_phone'] ?></p>
                    </td>
                    <td>
                        <p><?= $book['room_type'] ?></p>
                        <p><?= $book['room_price'] ?></p>
                    </td>
                    <td>
                        <p><?= $book['payment_method'] ?></p>
                    </td>
                    <td>
                        <p><?= date('d M Y', strtotime($book['check_in_date'])) ?></p>
                    </td>
                    <td>
                        <p><?= date('d M Y', strtotime($book['check_out_date'])) ?></p>
                    </td>
                    <td>
                        <p><?= $book['total_price'] ?></p>
                    </td>
                    <td>
                        <button class="btn btn-outline-primary">
                            <?= $book['status'];?>
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Detail
                        </button>
                    </td>
                </tr>
                <tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <!-- End Table with stripped rows -->
    
        <?php foreach($bookings as $book): ?>
            <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $book['guest_name'] ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Pesan</h6>
                <p><?= $book['special_requests'] ?></p>
                
                                
                <form method="post" action="<?= base_url('admin/bookings/update-status') ?>" class="d-inline">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="booking_id" value="<?= $book['id'] ?>">
                    
                    <h6>Status</h6>
                    <select name="status" class="form-select form-select-sm" style="width: auto; display: inline-block;">
                        <option value="pending" <?= $book['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="confirmed" <?= $book['status'] == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                        <option value="cancelled" <?= $book['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                        <option value="completed" <?= $book['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                        <option value="no_show" <?= $book['status'] == 'no_show' ? 'selected' : '' ?>>No Show</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary ms-2">Update</button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>
        <?php endforeach ?>

    </div>
</div>

<!-- TABLE END -->

<!-- AJAX -->
<?php echo $this->endSection() ?>