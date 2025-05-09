<?php
/**
 * Hotel Card Component
 * 
 * @param array $hotel - Hotel data including:
 *   - id, name, city_name, star_rating, rating, review_count, cover_photo
 */
?>

<div class="hotel-card" onclick="window.location.href='<?= base_url('hotels/' . $hotel['id']) ?>'">
    <div class="hotel-image">
        <img src="<?= base_url()?>/uploads/hotels/<?= $hotel['cover_photo'] ?? 'https://source.unsplash.com/random/434x240/?hotel,accommodation' ?>" 
             alt="<?= esc($hotel['name']) ?>" 
             loading="lazy">
    </div>
    <div class="card-content">
        <h3 class="hotel-name"><?= esc($hotel['name']) ?></h3>
        <p class="location">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="#6D6D6D">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
            </svg>
            <?= esc($hotel['city_name'] ?? 'City') ?>
        </p>
        <div class="stars">
            <?= str_repeat('★', (int)$hotel['star_rating']) ?>
            <?= str_repeat('☆', 5 - (int)$hotel['star_rating']) ?>
        </div>
        <div class="rating-container">
            <span class="rating-badge"><?= number_format($hotel['rating'] ?? 4.0, 1) ?> / 5</span>
            <span class="reviews">(<?= $hotel['review_count'] ?? 0 ?> reviews)</span>
        </div>
    </div>
</div>

<style>
.hotel-card {
    width: 300px;
    height: 240px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    overflow: hidden;
    background: white;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.hotel-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}

.hotel-image {
    height: 120px;
    width: 100%;
    overflow: hidden;
    position: relative;
}

.hotel-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.hotel-card:hover .hotel-image img {
    transform: scale(1.05);
}

.card-content {
    padding: 12px;
    flex: 1;
    display: flex;
    flex-direction: column;
    position: relative;
}

.hotel-name {
    font-family: 'Gothic', sans-serif;
    font-size: 16px;
    margin: 0 0 4px 0;
    color: #1F1F1F;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.location {
    font-size: 12px;
    color: #6D6D6D;
    margin: 0 0 8px 0;
    display: flex;
    align-items: center;
}

.stars {
    color: #FFD700;
    margin-bottom: 20px;
    font-size: 14px;
    letter-spacing: 1px;
}

.rating-container {
    position: absolute;
    bottom: 12px;
    right: 12px;
    display: flex;
    align-items: center;
}

.rating-badge {
    background-color: #0176C8;
    color: #F6F6F6;
    border-radius: 4px;
    padding: 3px 6px;
    font-size: 12px;
    font-weight: bold;
}

.reviews {
    font-size: 10px;
    color: #6D6D6D;
    margin-left: 4px;
}
</style>