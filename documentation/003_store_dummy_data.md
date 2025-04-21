# **Data Dummy untuk Sistem Pemesanan Hotel**

Berikut data dummy lengkap yang akan saya sarankan untuk mengisi database Anda. Data ini dirancang untuk:

-   Memenuhi relasi antar tabel
-   Cukup realistis untuk testing fitur
-   Mencover berbagai skenario penggunaan

## **1. Data Kota (Cities)**

```sql
INSERT INTO cities (name, province) VALUES
('Jakarta', 'DKI Jakarta'),
('Bandung', 'Jawa Barat'),
('Bali', 'Bali'),
('Yogyakarta', 'DI Yogyakarta'),
('Surabaya', 'Jawa Timur');
```

## **2. Data Kategori Hotel (Categories)**

```sql
INSERT INTO categories (name, description, icon) VALUES
('Budget', 'Hotel dengan harga terjangkau', 'fa-hotel'),
('Boutique', 'Hotel kecil dengan desain unik', 'fa-building'),
('Luxury', 'Hotel bintang 5 dengan fasilitas mewah', 'fa-crown'),
('Resort', 'Hotel dengan konsep resort dan pantai', 'fa-umbrella-beach'),
('Business', 'Hotel untuk keperluan bisnis', 'fa-briefcase');
```

## **3. Data Metode Pembayaran (Payment Methods)**

```sql
INSERT INTO payment_methods (name, code, type, icon) VALUES
('BCA Virtual Account', 'BCA_VA', 'bank_transfer', 'bca.png'),
('Mandiri Virtual Account', 'MANDIRI_VA', 'bank_transfer', 'mandiri.png'),
('BNI Virtual Account', 'BNI_VA', 'bank_transfer', 'bni.png'),
('OVO', 'OVO', 'e_wallet', 'ovo.png'),
('GoPay', 'GOPAY', 'e_wallet', 'gopay.png'),
('Dana', 'DANA', 'e_wallet', 'dana.png'),
('Cash On Arrival', 'CASH', 'cash', 'cash.png');
```

## **4. Data Pengguna (Users)**

```sql
-- Password untuk semua user: password123
INSERT INTO users (username, email, password, full_name, phone, role) VALUES
-- Super Admin
('admin', 'admin@hotel.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin Sistem', '081234567890', 'admin'),

-- Admin Hotel
('admin_jkt', 'admin_jkt@hotel.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin Jakarta', '081234567891', 'hotel'),
('admin_bdg', 'admin_bdg@hotel.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin Bandung', '081234567892', 'hotel'),

-- User Biasa
('user1', 'user1@mail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Budi Santoso', '081234567893', 'user'),
('user2', 'user2@mail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ani Wijaya', '081234567894', 'user');
```

## **5. Data Hotel (Hotels)**

```sql
INSERT INTO hotels (name, description, address, city_id, admin_id, star_rating, cover_photo) VALUES
-- Jakarta
('Hotel Indonesia Kempinski', 'Hotel mewah di jantung Jakarta', 'Jl. MH Thamrin No.1, Jakarta', 1, 2, 5, 'kempinski.jpg'),
('Ibis Jakarta Tamarin', 'Hotel budget dengan lokasi strategis', 'Jl. KH Wahid Hasyim, Jakarta', 1, 2, 3, 'ibis.jpg'),

-- Bandung
('The Trans Luxury Hotel', 'Hotel bintang 5 di Bandung', 'Jl. Gatot Subroto, Bandung', 2, 3, 5, 'trans.jpg'),
('Hilton Bandung', 'Hotel internasional di Bandung', 'Jl. HOS Cokroaminoto, Bandung', 2, 3, 4, 'hilton.jpg'),

-- Bali
('The Mulia Resort', 'Resort mewah di Nusa Dua', 'Jl. Raya Nusa Dua Selatan, Bali', 3, 2, 5, 'mulia.jpg'),
('Pondok Sari Hotel', 'Hotel budget dekat pantai Kuta', 'Jl. Pantai Kuta, Bali', 3, 3, 2, 'pondoksari.jpg');
```

## **6. Relasi Hotel-Kategori (Hotel Categories)**

```sql
INSERT INTO hotel_categories (hotel_id, category_id) VALUES
(1, 3), (1, 5), -- Kempinski: Luxury + Business
(2, 1),         -- Ibis: Budget
(3, 3), (3, 4), -- Trans: Luxury + Resort
(4, 3), (4, 5), -- Hilton: Luxury + Business
(5, 3), (5, 4), -- Mulia: Luxury + Resort
(6, 1), (6, 4); -- Pondok Sari: Budget + Resort
```

## **7. Fasilitas Hotel (Facilities)**

```sql
INSERT INTO facilities (hotel_id, name, icon) VALUES
-- Kempinski
(1, 'Kolam Renang', 'pool.png'),
(1, 'Spa', 'spa.png'),
(1, 'Restoran', 'restaurant.png'),

-- Ibis
(2, 'WiFi Gratis', 'wifi.png'),
(2, 'Parkir Gratis', 'parking.png'),

-- Trans Bandung
(3, 'Kolam Renang Infinity', 'pool.png'),
(3, 'Kids Club', 'kids.png'),
(3, 'Ballroom', 'event.png');
```

## **8. Tipe Kamar (Room Types)**

```sql
INSERT INTO room_types (hotel_id, name, description, base_price, capacity, available_rooms) VALUES
-- Kempinski
(1, 'Deluxe Room', 'Kamar luas dengan view kota', 2500000, 2, 10),
(1, 'Suite Room', 'Kamar suite dengan living room', 4500000, 4, 5),

-- Ibis
(2, 'Standard Room', 'Kamar standar nyaman', 600000, 2, 20),
(2, 'Twin Room', 'Kamar dengan 2 single bed', 750000, 2, 15),

-- Trans Bandung
(3, 'Executive Suite', 'Suite dengan view gunung', 3000000, 2, 8),
(3, 'Presidential Suite', 'Kamar termewah di hotel', 8000000, 4, 2);
```

## **9. Data Pemesanan (Bookings)**

```sql
INSERT INTO bookings (user_id, hotel_id, room_type_id, payment_method_id, check_in_date, check_out_date, adults, children, total_price, status, payment_status) VALUES
-- Booking aktif user1
(4, 1, 1, 1, '2023-11-15', '2023-11-17', 2, 0, 5000000, 'confirmed', 'paid'),

-- Booking selesai user1
(4, 2, 3, 7, '2023-10-01', '2023-10-03', 1, 0, 1200000, 'completed', 'paid'),

-- Booking dibatalkan user2
(5, 3, 5, 3, '2023-12-20', '2023-12-25', 2, 1, 15000000, 'cancelled', 'refunded');
```

## **10. Ulasan (Reviews)**

```sql
INSERT INTO reviews (booking_id, user_id, hotel_id, rating, comment) VALUES
(2, 4, 2, 4, 'Pelayanan bagus, kamar bersih tapi agak kecil'),
(1, 4, 1, 5, 'Pengalaman menginap yang luar biasa!');
```

## **11. Data Favorit (Favorites)**

```sql
INSERT INTO favorites (user_id, hotel_id) VALUES
(4, 1), -- User1 favoritkan Kempinski
(4, 3), -- User1 favoritkan Trans Bandung
(5, 5); -- User2 favoritkan Mulia
```

## **Cara Eksekusi Data Dummy**

1. Simpan semua query di atas ke file `seed_data.sql`
2. Jalankan via terminal:
    ```bash
    mysql -u root -p hotel_booking < seed_data.sql
    ```

## **Tips Testing Aplikasi**

1. **Login sebagai**:

    - Super Admin: `admin@hotel.com` / `password123`
    - Admin Hotel Jakarta: `admin_jkt@hotel.com` / `password123`
    - User Biasa: `user1@mail.com` / `password123`

2. **Scenario Testing**:
    - User mencari hotel di Jakarta
    - User memesan kamar deluxe di Kempinski
    - Admin hotel mengkonfirmasi pemesanan
    - User memberikan review setelah checkout

Mau saya tambahkan data dummy yang lebih spesifik untuk fitur tertentu? Atau lanjut ke implementasi controller dan view?
