# **Dokumentasi Lengkap Sistem Basis Data Aplikasi Pemesanan Hotel**

## **1. Gambaran Umum**

Basis data ini dirancang untuk sistem pemesanan hotel dengan fitur:

-   **3 Role Pengguna**: User Biasa, Admin Hotel, dan Super Admin
-   **Manajemen Hotel**: Pendaftaran hotel, kategori, fasilitas, dan tipe kamar
-   **Pemesanan**: Booking kamar, pembayaran, dan riwayat transaksi
-   **Ulasan & Rating**: Sistem review dan keluhan pengguna

## **2. Struktur Tabel Lengkap**

### **2.1 Tabel Users**

**Deskripsi**: Menyimpan data semua pengguna sistem (user, admin hotel, super admin)

```sql
CREATE TABLE users (
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
);
```

**Relasi**:

-   Terhubung ke: `hotels(admin_id)`, `bookings(user_id)`, `reviews(user_id)`

---

### **2.2 Tabel Cities**

**Deskripsi**: Daftar kota tempat hotel berada

```sql
CREATE TABLE cities (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    province VARCHAR(50),
    country VARCHAR(50) DEFAULT 'Indonesia'
);
```

**Relasi**:

-   Terhubung ke: `hotels(city_id)`

---

### **2.3 Tabel Hotels**

**Deskripsi**: Informasi lengkap hotel

```sql
CREATE TABLE hotels (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    address TEXT NOT NULL,
    city_id INT NOT NULL,
    admin_id INT NOT NULL,
    star_rating TINYINT,
    cover_photo VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (city_id) REFERENCES cities(id),
    FOREIGN KEY (admin_id) REFERENCES users(id)
);
```

**Relasi**:

-   Terhubung ke: `room_types(hotel_id)`, `facilities(hotel_id)`, `bookings(hotel_id)`

---

### **2.4 Tabel Categories**

**Deskripsi**: Kategori hotel (Boutique, Budget, Luxury, dll)

```sql
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    icon VARCHAR(50)
);
```

---

### **2.5 Tabel Hotel_Categories**

**Deskripsi**: Menghubungkan hotel dengan kategori (many-to-many)

```sql
CREATE TABLE hotel_categories (
    hotel_id INT NOT NULL,
    category_id INT NOT NULL,
    PRIMARY KEY (hotel_id, category_id),
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);
```

---

### **2.6 Tabel Room_Types**

**Deskripsi**: Tipe kamar yang tersedia di setiap hotel

```sql
CREATE TABLE room_types (
    id INT PRIMARY KEY AUTO_INCREMENT,
    hotel_id INT NOT NULL,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    base_price DECIMAL(12,2) NOT NULL,
    capacity INT DEFAULT 2,
    available_rooms INT DEFAULT 0,
    photo VARCHAR(100),
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE
);
```

**Relasi**:

-   Terhubung ke: `bookings(room_type_id)`

---

### **2.7 Tabel Facilities**

**Deskripsi**: Fasilitas yang dimiliki hotel

```sql
CREATE TABLE facilities (
    id INT PRIMARY KEY AUTO_INCREMENT,
    hotel_id INT NOT NULL,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    icon VARCHAR(30),
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE
);
```

---

### **2.8 Tabel Payment_Methods**

**Deskripsi**: Metode pembayaran yang diterima sistem

```sql
CREATE TABLE payment_methods (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    code VARCHAR(20) UNIQUE NOT NULL,
    type ENUM('bank_transfer','e_wallet','credit_card','cash') NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    icon VARCHAR(50)
);
```

**Relasi**:

-   Terhubung ke: `bookings(payment_method_id)`

---

### **2.9 Tabel Bookings**

**Deskripsi**: Transaksi pemesanan kamar

```sql
CREATE TABLE bookings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    hotel_id INT NOT NULL,
    room_type_id INT NOT NULL,
    payment_method_id INT,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    total_price DECIMAL(12,2) NOT NULL,
    status ENUM('pending','confirmed','cancelled','completed') DEFAULT 'pending',
    payment_status ENUM('pending','paid','failed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (hotel_id) REFERENCES hotels(id),
    FOREIGN KEY (room_type_id) REFERENCES room_types(id),
    FOREIGN KEY (payment_method_id) REFERENCES payment_methods(id)
);
```

---

### **2.10 Tabel Reviews**

**Deskripsi**: Ulasan dan rating dari user

```sql
CREATE TABLE reviews (
    id INT PRIMARY KEY AUTO_INCREMENT,
    booking_id INT NOT NULL,
    user_id INT NOT NULL,
    hotel_id INT NOT NULL,
    rating TINYINT NOT NULL CHECK (rating BETWEEN 1 AND 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (booking_id) REFERENCES bookings(id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (hotel_id) REFERENCES hotels(id)
);
```

---

### **2.11 Tabel Complaints**

**Deskripsi**: Keluhan dari pengguna

```sql
CREATE TABLE complaints (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    hotel_id INT NOT NULL,
    message TEXT NOT NULL,
    status ENUM('open','resolved') DEFAULT 'open',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (hotel_id) REFERENCES hotels(id)
);
```

---

### **2.12 Tabel Favorites**

**Deskripsi**: Daftar hotel favorit pengguna

```sql
CREATE TABLE favorites (
    user_id INT NOT NULL,
    hotel_id INT NOT NULL,
    PRIMARY KEY (user_id, hotel_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE
);
```

## **3. Diagram Relasi (ERD)**

```
users
│
├── hotels (admin_id)
│   │
│   ├── room_types (hotel_id)
│   ├── facilities (hotel_id)
│   └── hotel_categories (hotel_id)
│       └── categories (category_id)
│
├── bookings (user_id)
│   │
│   ├── room_types (room_type_id)
│   ├── hotels (hotel_id)
│   └── payment_methods (payment_method_id)
│
├── reviews (user_id)
│   ├── bookings (booking_id)
│   └── hotels (hotel_id)
│
├── complaints (user_id)
│   └── hotels (hotel_id)
│
└── favorites (user_id)
    └── hotels (hotel_id)
```

## **4. Panduan Implementasi**

### **4.1 Indeks yang Direkomendasikan**

```sql
CREATE INDEX idx_hotel_city ON hotels(city_id);
CREATE INDEX idx_booking_dates ON bookings(check_in_date, check_out_date);
CREATE INDEX idx_room_hotel ON room_types(hotel_id);
```

### **4.2 Contoh Data Awal**

```sql
-- Kota
INSERT INTO cities (name, province) VALUES
('Jakarta', 'DKI Jakarta'),
('Bandung', 'Jawa Barat');

-- Kategori Hotel
INSERT INTO categories (name) VALUES
('Budget'), ('Boutique'), ('Luxury');

-- Metode Pembayaran
INSERT INTO payment_methods (name, code, type) VALUES
('BCA Virtual Account', 'BCA_VA', 'bank_transfer'),
('OVO', 'OVO', 'e_wallet');
```

## **5. Catatan Versi**

-   **v1.0** (2023-10-15): Struktur awal dengan AUTO_INCREMENT
-   **v1.1** (2023-10-16): Penambahan tabel payment_methods dan categories yang sempat terlewat

Dokumentasi ini mencakup semua kebutuhan sistem Anda dan siap untuk diimplementasikan dengan CodeIgniter 4.
