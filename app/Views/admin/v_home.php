<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="pagetitle">
    <h1>Dashboard Admin Hotel</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">
    <div class="row">
        <!-- Statistik Card -->
        <div class="col-lg-4 col-md-6">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title">Total Kamar</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-door-open"></i>
                        </div>
                        <div class="ps-3">
                            <h6><?= $total_rooms ?></h6>
                            <span class="text-success small pt-1 fw-bold">Kamar Tersedia</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Total Pemesanan</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div class="ps-3">
                            <h6><?= $total_bookings ?></h6>
                            <span class="text-success small pt-1 fw-bold">Transaksi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Keluhan Masuk</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div class="ps-3">
                            <h6><?= $total_complaints ?></h6>
                            <span class="text-danger small pt-1 fw-bold">Perlu Tindakan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pemesanan Terbaru -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pemesanan Terbaru</h5>

                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Tamu</th>
                                <th scope="col">Check In/Out</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($recent_bookings as $booking): ?>
                            <tr>
                                <td>#<?= strtoupper(substr($booking['id'], 0, 8)) ?></td>
                                <td><?= esc($booking['full_name']) ?></td>
                                <td>
                                    <?= date('d M', strtotime($booking['check_in_date'])) ?> - 
                                    <?= date('d M Y', strtotime($booking['check_out_date'])) ?>
                                </td>
                                <td>
                                    <span class="badge bg-<?= 
                                        $booking['status'] == 'confirmed' ? 'success' : 
                                        ($booking['status'] == 'pending' ? 'warning' : 'danger') 
                                    ?>">
                                        <?= ucfirst($booking['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= base_url('/admin/pemesanan/'.$booking['id']) ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Grafik Okupansi Kamar -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Okupansi Kamar</h5>
                    <div id="occupancyChart" style="min-height: 300px;"></div>
                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            new ApexCharts(document.querySelector("#occupancyChart"), {
                                series: [{
                                    name: 'Terisi',
                                    data: [31, 40, 28, 51, 42, 82, 56]
                                }, {
                                    name: 'Tersedia',
                                    data: [11, 32, 45, 32, 34, 52, 41]
                                }],
                                chart: {
                                    height: 350,
                                    type: 'area',
                                    toolbar: { show: false }
                                },
                                colors: ['#4154f1', '#2eca6a'],
                                dataLabels: { enabled: false },
                                stroke: { curve: 'smooth' },
                                xaxis: {
                                    type: 'datetime',
                                    categories: [
                                        "2023-09-01", "2023-09-02", "2023-09-03", 
                                        "2023-09-04", "2023-09-05", "2023-09-06", 
                                        "2023-09-07"
                                    ]
                                },
                                tooltip: {
                                    x: { format: 'dd/MM/yy' }
                                }
                            }).render();
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>