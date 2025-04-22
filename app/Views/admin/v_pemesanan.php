<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="pagetitle">
    <h1>Manajemen Pemesanan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Pemesanan</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Pemesanan</h5>

                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kode Booking</th>
                                <th scope="col">Tamu</th>
                                <th scope="col">Tipe Kamar</th>
                                <th scope="col">Check In/Out</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($bookings as $index => $booking): ?>
                            <tr>
                                <th scope="row"><?= $index + 1 ?></th>
                                <td>#<?= strtoupper(substr($booking['id'], 0, 8)) ?></td>
                                <td><?= esc($booking['full_name']) ?></td>
                                <td><?= esc($booking['room_name']) ?></td>
                                <td>
                                    <?= date('d M Y', strtotime($booking['check_in_date'])) ?><br>
                                    <?= date('d M Y', strtotime($booking['check_out_date'])) ?>
                                </td>
                                <td><?= number_to_currency($booking['total_price'], 'IDR') ?></td>
                                <td>
                                    <span class="badge bg-<?= 
                                        $booking['status'] == 'confirmed' ? 'success' : 
                                        ($booking['status'] == 'pending' ? 'warning' : 
                                        ($booking['status'] == 'cancelled' ? 'danger' : 'primary')) 
                                    ?>">
                                        <?= ucfirst($booking['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="<?= base_url('/admin/pemesanan/'.$booking['id']) ?>">
                                                    <i class="bi bi-eye"></i> Detail
                                                </a>
                                            </li>
                                            <li>
                                                <form action="<?= base_url('/admin/pemesanan/update-status/'.$booking['id']) ?>" method="post">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <div class="px-3 py-1">
                                                        <label class="form-label">Ubah Status</label>
                                                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                            <?php foreach($statuses as $status): ?>
                                                            <option value="<?= $status ?>" <?= $booking['status'] == $status ? 'selected' : '' ?>>
                                                                <?= ucfirst($status) ?>
                                                            </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>