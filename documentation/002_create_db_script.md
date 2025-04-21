# **Script Lengkap Pembuatan Database via Terminal**

Berikut script SQL lengkap untuk membuat database beserta semua tabel dan relasinya yang bisa Anda eksekusi via terminal MySQL:

## **1. Persiapan Awal**

Login ke MySQL via terminal:
```bash
mysql -u root -p
```

## **2. Script Pembuatan Database**

```sql
-- 1. Buat database
CREATE DATABASE IF NOT EXISTS hotel_booking;
USE hotel_booking;

-- 2. Buat tabel users
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(140) NOT NULL,
    phone VARCHAR(15),
    photo VARCHAR(50) DEFAULT 'default.jpg',
    role ENUM('user','hotel','admin') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 3. Buat tabel cities
CREATE TABLE IF NOT EXISTS cities (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    province VARCHAR(50),
    country VARCHAR(50) DEFAULT 'Indonesia'
) ENGINE=InnoDB;

-- 4. Buat tabel payment_methods
CREATE TABLE IF NOT EXISTS payment_methods (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    code VARCHAR(20) UNIQUE NOT NULL,
    type ENUM('bank_transfer','e_wallet','credit_card','cash') NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    icon VARCHAR(50)
) ENGINE=InnoDB;

-- 5. Buat tabel categories
CREATE TABLE IF NOT EXISTS categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    icon VARCHAR(50)
) ENGINE=InnoDB;

-- 6. Buat tabel hotels
CREATE TABLE IF NOT EXISTS hotels (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    address TEXT NOT NULL,
    city_id INT NOT NULL,
    admin_id INT NOT NULL,
    star_rating TINYINT,
    cover_photo VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (city_id) REFERENCES cities(id) ON DELETE RESTRICT,
    FOREIGN KEY (admin_id) REFERENCES users(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

-- 7. Buat junction table hotel_categories
CREATE TABLE IF NOT EXISTS hotel_categories (
    hotel_id INT NOT NULL,
    category_id INT NOT NULL,
    PRIMARY KEY (hotel_id, category_id),
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 8. Buat tabel room_types
CREATE TABLE IF NOT EXISTS room_types (
    id INT PRIMARY KEY AUTO_INCREMENT,
    hotel_id INT NOT NULL,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    base_price DECIMAL(12,2) NOT NULL,
    capacity INT DEFAULT 2,
    available_rooms INT DEFAULT 0,
    photo VARCHAR(100),
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 9. Buat tabel facilities
CREATE TABLE IF NOT EXISTS facilities (
    id INT PRIMARY KEY AUTO_INCREMENT,
    hotel_id INT NOT NULL,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    icon VARCHAR(30),
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 10. Buat tabel bookings
CREATE TABLE IF NOT EXISTS bookings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    hotel_id INT NOT NULL,
    room_type_id INT NOT NULL,
    payment_method_id INT,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    adults INT NOT NULL DEFAULT 1,
    children INT NOT NULL DEFAULT 0,
    total_price DECIMAL(12,2) NOT NULL,
    status ENUM('pending','confirmed','cancelled','completed','no_show') DEFAULT 'pending',
    payment_status ENUM('pending','paid','failed','refunded') DEFAULT 'pending',
    payment_proof VARCHAR(100),
    special_requests TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE RESTRICT,
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE RESTRICT,
    FOREIGN KEY (room_type_id) REFERENCES room_types(id) ON DELETE RESTRICT,
    FOREIGN KEY (payment_method_id) REFERENCES payment_methods(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- 11. Buat tabel reviews
CREATE TABLE IF NOT EXISTS reviews (
    id INT PRIMARY KEY AUTO_INCREMENT,
    booking_id INT NOT NULL,
    user_id INT NOT NULL,
    hotel_id INT NOT NULL,
    rating TINYINT NOT NULL CHECK (rating BETWEEN 1 AND 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE RESTRICT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE RESTRICT,
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 12. Buat tabel complaints
CREATE TABLE IF NOT EXISTS complaints (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    hotel_id INT NOT NULL,
    message TEXT NOT NULL,
    status ENUM('open','resolved') DEFAULT 'open',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE RESTRICT,
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 13. Buat tabel favorites
CREATE TABLE IF NOT EXISTS favorites (
    user_id INT NOT NULL,
    hotel_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, hotel_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 14. Tambahkan index untuk performa
CREATE INDEX idx_hotel_city ON hotels(city_id);
CREATE INDEX idx_booking_dates ON bookings(check_in_date, check_out_date);
CREATE INDEX idx_booking_status ON bookings(status);
CREATE INDEX idx_room_hotel ON room_types(hotel_id);
```

## **3. Cara Eksekusi via Terminal**

1. Simpan script di atas ke file `create_hotel_db.sql`
2. Eksekusi dari terminal:

```bash
mysql -u root -p < create_hotel_db.sql
```

Atau jika ingin eksekusi langsung:

```bash
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS hotel_booking;"
mysql -u root -p hotel_booking < create_hotel_db.sql
```

## **4. Verifikasi Database**

Untuk memastikan database berhasil dibuat, jalankan:

```bash
mysql -u root -p -e "USE hotel_booking; SHOW TABLES;"
```

Harusnya menampilkan daftar 12 tabel yang telah kita buat.


## **Catatan Penting**

1. Pastikan:
   - MySQL/MariaDB sudah terinstall
   - User MySQL memiliki privilege untuk membuat database
   - Tidak ada nama database `hotel_booking` yang sudah ada

2. Untuk development, Anda bisa menggunakan user `root` tanpa password dengan mengubah:
   ```bash
   mysql -u root < create_hotel_db.sql
   ```

3. Jika ada error foreign key constraint, pastikan urutan pembuatan tabel sesuai script di atas.

Mau saya tambahkan data dummy yang lebih lengkap untuk testing? Atau lanjut ke konfigurasi CodeIgniter setelah database siap?