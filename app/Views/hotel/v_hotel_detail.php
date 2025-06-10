<?php echo $this->extend("layout/layout_utama"); ?>
<?php echo $this->section("konten_utama") ?>

<div class="container py-5">

    <!-- ======== Galeri Hotel======== -->
    <!-- Galeri Hotel -->
    <div class="row mb-5">
        <div class="col-12">
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="carousel-image"
                            style="background-image: url('<?= !empty($hotel['cover_photo']) ? base_url('uploads/hotels/'.$hotel['cover_photo']) : 'https://source.unsplash.com/random/800x600/?hotel' ?>');">
                        </div>
                    </div>
                    <?php foreach ($gallery_photos as $photo): ?>
                        <div class="carousel-item">
                            <div class="carousel-image"
                                style="background-image: url('<?= base_url('uploads/galleries/' . $photo['photo']) ?>');">
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- Disini, setelah menampilkan cover_photo, saya ingin agar gallery di looping di sini.  -->
                    <!-- <div class="carousel-item">
                        <div class="carousel-image"
                            style="background-image: url('https://source.unsplash.com/random/800x600/?resort');">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-image"
                            style="background-image: url('https://source.unsplash.com/random/800x600/?room');">
                        </div>
                    </div> -->
                    <!-- sampai sini, jadi total div class caroursel-item adalah sebanyak gallery, dengan background image adalah foto di gallerynya -->
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <style>
            .carousel-image {
                height: 400px;
                background-size: cover;
                background-position: center;
                border-radius: 8px;
            }
        </style>

    </div>


    <!-- Header Hotel -->
    <div class="row mb-4">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <div class="col-md-8">
            <h1 class="font-heading"><?= esc($hotel['name']) ?></h1>
            <div class="d-flex align-items-center mb-2">
                <div class="me-3" style="color: #FFD700;">
                    <?= str_repeat('★', (int)$hotel['star_rating']) ?><?= str_repeat('☆', 5 - (int)$hotel['star_rating']) ?>
                </div>
                <span class="badge text-dark me-2" style="background-color: #075085;"><?= number_format($avg_rating, 1) ?> / 5</span>
                <span class="text-muted">(<?= $total_reviews ?> ulasan)</span>
            </div>
            <div class="d-flex align-items-center text-muted mb-3">
                <i class="fas fa-map-marker-alt me-2"></i>
                <?= esc($hotel['address']) ?>
                <?php if (!empty($hotel['city_name'])): ?>
                    , <?= esc($hotel['city_name']) ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-4 text-md-end">
    <?php if ($user_role === 'user') : ?>
        <?php if ($isFavorite) : ?>
            <!-- Tombol hapus favorit -->
            <form action="<?= base_url('hotel/deleteFavorite') ?>" method="post" style="display: inline;">
                <input type="hidden" name="user_id" value="<?= $userId ?>">
                <input type="hidden" name="hotel_id" value="<?= $hotel['id'] ?>">
                <button type="submit" class="btn btn-lg btn-outline-primary" style="border-color: #0176C8;">
                    <i class="fas fa-star me-2"></i>Hapus dari Favorit
                </button>
            </form>
        <?php else : ?>
            <!-- Tombol tambah favorit -->
            <form action="<?= base_url('hotel/addFavorite') ?>" method="post" style="display: inline;">
                <input type="hidden" name="user_id" value="<?= $userId ?>">
                <input type="hidden" name="hotel_id" value="<?= $hotel['id'] ?>">
                <button type="submit" class="btn btn-lg btn-primary" style="background-color: #0176C8; border-color: #0176C8;">
                    <i class="fas fa-star me-2"></i>Tambah ke Favorit
                </button>
            </form>
        <?php endif; ?>
    <?php else : ?>
        <button class="btn btn-lg btn-primary disabled" style="background-color: #0176C8; border-color: #0176C8;">
            <i class="fas fa-star me-2"></i>Tambah ke Favorit
        </button>
    <?php endif; ?>
</div>
    </div>

    <!-- ======== Info Hotel  ========-->
    <div class="row">
        <div class="">
            <!-- Deskripsi -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="font-heading mb-4">Tentang Hotel Ini</h3>
                    <p><?= !empty($hotel['description']) ? nl2br(esc($hotel['description'])) : 'Hotel ini menawarkan akomodasi dengan layanan dan fasilitas yang lengkap.' ?></p>
                </div>
            </div>

            <!-- ======== Fasilitas ======== -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="font-heading mb-4">Fasilitas & Layanan</h3>
                    <div class="row">
                        <?php if (!empty($facilities)): ?>
                            <?php foreach ($facilities as $facility): ?>
                            <div class="col-md-4 mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span><?= esc($facility['name']) ?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12">
                                <p class="text-muted">Informasi fasilitas belum tersedia</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Tipe Kamar -->
            <div class="card mb-4 border-0 shadow-sm" id="tipekamarr">
                <div class="card-body">
                    <h3 class="font-heading mb-4">Tipe Kamar</h3>
                    <?php if (!empty($room_types)): ?>
                        <?php foreach ($room_types as $room): ?>
                        <div class="mb-4 pb-4 border-bottom">
                            <div class="row">
                                <!-- <div class="col-md-4"> -->
                                    <!-- buat bawah ini menjadi caroursel juga,,, ibarat ada 3 foto.  -->
                                    <!-- <img src="" class="img-fluid rounded" alt=""> -->
                                <!-- </div> -->

                              <div class="col-md-4">
                                <div id="roomCarousel<?= $room['id'] ?>" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php
                                            $hasMainPhoto = !empty($room['photo']);
                                            $galleryPhotos = $room['galleries'] ?? [];
                                            $first = true;

                                            // Jika ada foto utama room
                                            if ($hasMainPhoto):
                                        ?>
                                            <div class="carousel-item active">
                                                <img src="<?= base_url('uploads/rooms/' . $room['photo']) ?>" class="d-block w-100 rounded" style="height: 200px; object-fit: cover;" alt="<?= esc($room['name']) ?>">
                                            </div>
                                            <?php $first = false; ?>
                                        <?php endif; ?>

                                        <?php foreach ($galleryPhotos as $index => $gallery): ?>
                                            <div class="carousel-item <?= (!$hasMainPhoto && $index === 0) ? 'active' : '' ?>">
                                                <img src="<?= base_url('uploads/room_gallery/' . $gallery['photo']) ?>" class="d-block w-100 rounded" style="height: 200px; object-fit: cover;" alt="Galeri <?= esc($room['name']) ?>">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <?php if ($hasMainPhoto || count($galleryPhotos) > 1): ?>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel<?= $room['id'] ?>" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel<?= $room['id'] ?>" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                                <div class="col-md-8">
                                    <h4><?= esc($room['name']) ?></h4>
                                    <p><?= esc($room['description']) ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="fw-bold"><?= number_to_currency($room['base_price'], 'IDR') ?></span>
                                            <span class="text-muted">/malam</span>
                                        </div>
                                        <a href="/booking/new/<?= $hotel['id']?>/<?= $room['id']?>" class="btn btn-sm btn-primary <?= ($user_role !== 'user') ? 'disabled' : '' ?>">Pesan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">Informasi kamar belum tersedia</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Ulasan -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="font-heading mb-4">Ulasan Tamu</h3>
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-4 text-center">
                            <h2 class="mb-0"><?= number_format($avg_rating, 1) ?></h2>
                            <div class="text-warning">
                                <?= str_repeat('★', round($avg_rating)) ?>
                            </div>
                            <small class="text-muted"><?= $total_reviews ?> ulasan</small>
                        </div>
                        <div class="flex-grow-1">
                            <?php foreach ([5,4,3,2,1] as $stars): ?>
                            <div class="d-flex align-items-center mb-2">
                                <small class="me-2"><?= $stars ?> bintang</small>
                                <div class="progress flex-grow-1" style="height: 8px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $rating_percent['rating_'.$stars] ?>%;" aria-valuenow="<?= $rating_percent['rating_'.$stars] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="ms-2 text-muted"><?= $rating_percent['rating_'.$stars] ?>%</small>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <?php if (!empty($reviews)): ?>
                        <?php foreach ($reviews as $review): ?>
                        <div class="review mb-4 pb-4 border-bottom">
                            <div class="d-flex align-items-center mb-3">
                                <img src="<?= !empty($review['photo']) ? base_url('uploads/profiles/'.$review['photo']) : base_url('/dummy/person.png') ?>" class="rounded-circle me-3" width="50" height="50" alt="<?= esc($review['full_name']) ?>">
                                <div>
                                    <h5 class="mb-0"><?= esc($review['full_name']) ?></h5>
                                    <small class="text-muted"><?= date('d M Y', strtotime($review['created_at'])) ?></small>
                                </div>
                            </div>
                            <div class="text-warning mb-2">
                                <?= str_repeat('★', $review['rating']) ?><?= str_repeat('☆', 5 - $review['rating']) ?>
                            </div>
                            <p><?= esc($review['comment']) ?></p>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">Belum ada ulasan untuk hotel ini</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>


    </div>

    <!-- Hotel Serupa -->
    <?php if (!empty($similar_hotels)): ?>
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="font-heading mb-4">Hotel Serupa di <?= esc($hotel['city_name']) ?></h3>
            <div class="row">
                <?php foreach ($similar_hotels as $similar): ?>
                <div class="col-md-4 mb-4">
                    <?= view('components/card_hotel', ['hotel' => $similar]) ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php echo $this->endSection() ?>