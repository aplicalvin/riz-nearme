<?php echo $this->extend("layout/layout_utama"); ?>
<?php echo $this->section("konten_utama") ?>

<!-- Hero Section -->
<section class="hero-section" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('<?= base_url('assets/images/landing.png') ?>'); background-size: cover; background-position: center; padding: 120px 0; color: white; text-align: center;">
    <div class="container">
        <h1 class="font-heading" style="font-size: 3rem; margin-bottom: 20px;">Find Your Perfect Stay with NearMe</h1>
        <p style="font-size: 1.2rem; max-width: 700px; margin: 0 auto 30px;">Discover the best hotels at the best prices across Indonesia</p>
        
        <!-- Search Form -->
        <div class="search-box" style="background: white; padding: 20px; border-radius: 8px; max-width: 800px; margin: 0 auto; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <form action="<?= base_url('/search') ?>" method="get">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control form-control-lg" placeholder="Where are you going?" name="location" style="height: 50px;">
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control form-control-lg" placeholder="Check-in" style="height: 50px;">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100" style="height: 50px; background-color: #0176C8; border: none; color: #1F1F1F; font-weight: bold;">Search Hotels</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Popular Destinations -->
<section class="popular-destinations" style="padding: 60px 0; background-color: #F8F9FA;">
    <div class="container">
        <h2 class="font-heading text-center mb-5">Popular Destinations</h2>
        <div class="row">
            <?php
            $destinations = [
                ['name' => 'Bali', 'image' => 'https://source.unsplash.com/random/300x200/?bali'],
                ['name' => 'Jakarta', 'image' => 'https://source.unsplash.com/random/300x200/?jakarta'],
                ['name' => 'Yogyakarta', 'image' => 'https://source.unsplash.com/random/300x200/?yogyakarta'],
                ['name' => 'Bandung', 'image' => 'https://source.unsplash.com/random/300x200/?bandung']
            ];
            ?>
            
            <?php foreach ($destinations as $destination): ?>
            <div class="col-md-3 mb-4">
                <div class="destination-card" style="border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1); transition: transform 0.3s;">
                    <img src="<?= $destination['image'] ?>" alt="<?= $destination['name'] ?>" style="width: 100%; height: 150px; object-fit: cover;">
                    <div class="p-3" style="background: white;">
                        <h5 class="font-heading"><?= $destination['name'] ?></h5>
                        <a href="<?= base_url('/hotels?location=' . urlencode($destination['name'])) ?>" class="btn btn-sm" style="background-color: #0176C8; color: #1F1F1F;">Explore</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Featured Hotels -->
<section class="featured-hotels" style="padding: 60px 0;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="font-heading mb-0">Most Popular Hotels</h2>
            <a href="<?= base_url('/hotels') ?>" class="btn btn-outline-dark">View All</a>
        </div>
        
        <div class="row">
            <?php foreach ($hotels as $hotel): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <?= view('components/card_hotel', ['hotel' => $hotel]) ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="why-choose-us" style="padding: 60px 0; background-color: #1F1F1F; color: white;">
    <div class="container">
        <h2 class="font-heading text-center mb-5">Why Choose NearMe?</h2>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="p-4">
                    <i class="fas fa-percentage fa-3x mb-3" style="color: #0176C8;"></i>
                    <h4 class="font-heading">Best Price Guarantee</h4>
                    <p>We guarantee the best prices for your stay. Found a better deal? We'll match it!</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4">
                    <i class="fas fa-headset fa-3x mb-3" style="color: #0176C8;"></i>
                    <h4 class="font-heading">24/7 Customer Support</h4>
                    <p>Our support team is available around the clock to assist you with any queries.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4">
                    <i class="fas fa-map-marked-alt fa-3x mb-3" style="color: #0176C8;"></i>
                    <h4 class="font-heading">Wide Selection</h4>
                    <p>Thousands of hotels across Indonesia to choose from for your perfect stay.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php echo $this->endSection() ?>