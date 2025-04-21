# **Daftar Model yang Dibutuhkan untuk Sistem Pemesanan Hotel**

Berdasarkan struktur database yang sudah kita buat, berikut daftar lengkap model yang perlu Anda siapkan beserta fungsionalitas utamanya:

## **1. Model Inti (Wajib)**

### **1.1 UserModel**

**File:** `app/Models/UserModel.php`  
**Tabel:** `users`  
**Fungsi:**

-   Mengelola autentikasi user
-   Menangani registrasi admin hotel
-   Manajemen profil pengguna

```php
<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'email', 'password', 'full_name', 'phone', 'photo', 'role'];
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    // Contoh method khusus
    public function getHotelAdmins()
    {
        return $this->where('role', 'hotel')->findAll();
    }
}
```

### **1.2 HotelModel**

**File:** `app/Models/HotelModel.php`  
**Tabel:** `hotels`  
**Fungsi:**

-   Mengelola data hotel
-   Pencarian berdasarkan kota
-   Relasi dengan fasilitas dan kamar

```php
<?php namespace App\Models;

use CodeIgniter\Model;

class HotelModel extends Model
{
    protected $table = 'hotels';
    protected $allowedFields = ['name', 'description', 'address', 'city_id', 'admin_id', 'star_rating', 'cover_photo'];

    public function getHotelsByCity($cityId)
    {
        return $this->where('city_id', $cityId)
                   ->join('cities', 'cities.id = hotels.city_id')
                   ->select('hotels.*, cities.name as city_name')
                   ->findAll();
    }

    public function getHotelWithCategories($hotelId)
    {
        $builder = $this->db->table('hotel_categories');
        $builder->select('categories.*')
               ->join('categories', 'categories.id = hotel_categories.category_id')
               ->where('hotel_categories.hotel_id', $hotelId);
        return $builder->get()->getResultArray();
    }
}
```

### **1.3 BookingModel**

**File:** `app/Models/BookingModel.php`  
**Tabel:** `bookings`  
**Fungsi:**

-   Proses pemesanan kamar
-   Update status booking
-   Riwayat transaksi user

```php
<?php namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $allowedFields = ['user_id', 'hotel_id', 'room_type_id', 'check_in_date', 'check_out_date', 'status'];

    public function getUserBookings($userId)
    {
        return $this->where('user_id', $userId)
                   ->orderBy('created_at', 'DESC')
                   ->findAll();
    }

    public function createBooking(array $data)
    {
        // Validasi tanggal dll bisa ditambahkan di sini
        return $this->insert($data);
    }
}
```

## **2. Model Pendukung (Wajib)**

### **2.1 CityModel**

**File:** `app/Models/CityModel.php`  
**Tabel:** `cities`  
**Fungsi:**

-   Manajemen data kota
-   Dropdown filter pencarian

```php
<?php namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model
{
    protected $table = 'cities';
    protected $allowedFields = ['name', 'province'];

    public function getCitiesWithHotels()
    {
        return $this->select('cities.*, COUNT(hotels.id) as hotel_count')
                   ->join('hotels', 'hotels.city_id = cities.id', 'left')
                   ->groupBy('cities.id')
                   ->findAll();
    }
}
```

### **2.2 RoomTypeModel**

**File:** `app/Models/RoomTypeModel.php`  
**Tabel:** `room_types`  
**Fungsi:**

-   Manajemen tipe kamar
-   Cek ketersediaan kamar

```php
<?php namespace App\Models;

use CodeIgniter\Model;

class RoomTypeModel extends Model
{
    protected $table = 'room_types';
    protected $allowedFields = ['hotel_id', 'name', 'base_price', 'capacity'];

    public function getAvailableRooms($hotelId, $checkIn, $checkOut)
    {
        // Logika cek kamar yang tersedia di tanggal tertentu
        return $this->where('hotel_id', $hotelId)
                   ->findAll();
    }
}
```

## **3. Model Tambahan (Opsional tapi Direkomendasikan)**

### **3.1 ReviewModel**

**File:** `app/Models/ReviewModel.php`  
**Tabel:** `reviews`  
**Fungsi:**

-   Menyimpan ulasan user
-   Hitung rating rata-rata hotel

```php
<?php namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = 'reviews';

    public function getHotelRating($hotelId)
    {
        return $this->selectAvg('rating')
                   ->where('hotel_id', $hotelId)
                   ->first();
    }
}
```

### **3.2 FacilityModel**

**File:** `app/Models/FacilityModel.php`  
**Tabel:** `facilities`  
**Fungsi:**

-   Manajemen fasilitas hotel
-   Relasi many-to-many dengan hotel

```php
<?php namespace App\Models;

use CodeIgniter\Model;

class FacilityModel extends Model
{
    protected $table = 'facilities';

    public function getFacilitiesByHotel($hotelId)
    {
        return $this->where('hotel_id', $hotelId)
                   ->findAll();
    }
}
```

## **4. Model untuk Admin**

### **4.1 PaymentMethodModel**

**File:** `app/Models/PaymentMethodModel.php`  
**Tabel:** `payment_methods`  
**Fungsi:**

-   Aktif/nonaktifkan metode pembayaran
-   Daftar metode yang tersedia

```php
<?php namespace App\Models;

use CodeIgniter\Model;

class PaymentMethodModel extends Model
{
    protected $table = 'payment_methods';

    public function getActiveMethods()
    {
        return $this->where('is_active', true)
                   ->findAll();
    }
}
```

### **4.2 ComplaintModel**

**File:** `app/Models/ComplaintModel.php`  
**Tabel:** `complaints`  
**Fungsi:**

-   Manajemen keluhan user
-   Update status keluhan

```php
<?php namespace App\Models;

use CodeIgniter\Model;

class ComplaintModel extends Model
{
    protected $table = 'complaints';

    public function getUnresolvedComplaints()
    {
        return $this->where('status', 'open')
                   ->orderBy('created_at', 'DESC')
                   ->findAll();
    }
}
```

## **Struktur Folder Model**

```
/app
  /Models
    - UserModel.php
    - HotelModel.php
    - BookingModel.php
    - CityModel.php
    - RoomTypeModel.php
    - ReviewModel.php
    - FacilityModel.php
    - PaymentMethodModel.php
    - ComplaintModel.php
```

## **Tips Pembuatan Model**

1. **Gunakan Command Generator**:

    ```bash
    php spark make:model HotelModel
    ```

2. **Always Use Timestamps**:

    ```php
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    ```

3. **Validation Rules**:

    ```php
    protected $validationRules = [
        'name' => 'required|min_length[3]',
        'email' => 'required|valid_email'
    ];
    ```

4. **Soft Delete** (jika perlu):
    ```php
    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';
    ```

Mau saya detailkan implementasi untuk model tertentu? Atau ada penyesuaian khusus yang Anda butuhkan?
