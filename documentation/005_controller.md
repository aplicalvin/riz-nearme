# **Daftar Lengkap Controller untuk Sistem Pemesanan Hotel**

Berikut semua controller yang diperlukan beserta implementasi dasarnya:

## **1. AuthController (Autentikasi)**

**File:** `app/Controllers/AuthController.php`

```php
<?php namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Tampilan Login
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login', ['title' => 'Login']);
    }

    // Proses Login
    public function attemptLogin()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Email atau password salah');
        }

        // Set session
        session()->set([
            'userId' => $user['id'],
            'userRole' => $user['role'],
            'isLoggedIn' => true
        ]);

        return redirect()->to($user['role'] === 'admin' ? '/admin' : '/');
    }

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
```

## **2. HotelController (Manajemen Hotel)**

**File:** `app/Controllers/HotelController.php`

```php
<?php namespace App\Controllers;

use App\Models\HotelModel;
use App\Models\CityModel;
use App\Models\FacilityModel;
use App\Models\RoomTypeModel;

class HotelController extends BaseController
{
    protected $hotelModel;
    protected $cityModel;
    protected $facilityModel;
    protected $roomTypeModel;

    public function __construct()
    {
        $this->hotelModel = new HotelModel();
        $this->cityModel = new CityModel();
        $this->facilityModel = new FacilityModel();
        $this->roomTypeModel = new RoomTypeModel();
    }

    // Tampilkan semua hotel (untuk user biasa)
    public function index()
    {
        $data = [
            'title' => 'Daftar Hotel',
            'hotels' => $this->hotelModel->getHotelsWithCities(),
            'cities' => $this->cityModel->findAll()
        ];

        return view('hotel/index', $data);
    }

    // Detail hotel
    public function show($id)
    {
        $hotel = $this->hotelModel->getHotelWithDetails($id);

        if (!$hotel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => $hotel['name'],
            'hotel' => $hotel,
            'facilities' => $this->facilityModel->where('hotel_id', $id)->findAll(),
            'rooms' => $this->roomTypeModel->where('hotel_id', $id)->findAll()
        ];

        return view('hotel/show', $data);
    }
}
```

## **3. BookingController (Pemesanan)**

**File:** `app/Controllers/BookingController.php`

```php
<?php namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\RoomTypeModel;
use App\Models\PaymentMethodModel;

class BookingController extends BaseController
{
    protected $bookingModel;
    protected $roomTypeModel;
    protected $paymentMethodModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->roomTypeModel = new RoomTypeModel();
        $this->paymentMethodModel = new PaymentMethodModel();
    }

    // Form pemesanan
    public function create($roomId)
    {
        $room = $this->roomTypeModel->find($roomId);
        if (!$room) {
            return redirect()->back()->with('error', 'Kamar tidak ditemukan');
        }

        $data = [
            'title' => 'Pesan Kamar',
            'room' => $room,
            'paymentMethods' => $this->paymentMethodModel->where('is_active', true)->findAll()
        ];

        return view('booking/create', $data);
    }

    // Proses pemesanan
    public function store()
    {
        $rules = [
            'room_id' => 'required|numeric',
            'check_in' => 'required|valid_date',
            'check_out' => 'required|valid_date|after_date[check_in]',
            'adults' => 'required|numeric',
            'payment_method' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $room = $this->roomTypeModel->find($this->request->getPost('room_id'));
        $totalDays = (strtotime($this->request->getPost('check_out')) - strtotime($this->request->getPost('check_in'))) / (60 * 60 * 24);
        $totalPrice = $room['base_price'] * $totalDays;

        $this->bookingModel->save([
            'user_id' => session()->get('userId'),
            'hotel_id' => $room['hotel_id'],
            'room_type_id' => $room['id'],
            'check_in_date' => $this->request->getPost('check_in'),
            'check_out_date' => $this->request->getPost('check_out'),
            'adults' => $this->request->getPost('adults'),
            'total_price' => $totalPrice,
            'payment_method_id' => $this->request->getPost('payment_method'),
            'status' => 'pending'
        ]);

        return redirect()->to('/bookings')->with('message', 'Pemesanan berhasil dibuat');
    }

    // Riwayat pemesanan user
    public function userBookings()
    {
        $data = [
            'title' => 'Riwayat Pemesanan',
            'bookings' => $this->bookingModel->getUserBookings(session()->get('userId'))
        ];

        return view('booking/history', $data);
    }
}
```

## **4. AdminController (Admin Hotel)**

**File:** `app/Controllers/Admin/AdminController.php`

```php
<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\HotelModel;
use App\Models\BookingModel;
use App\Models\ComplaintModel;

class AdminController extends BaseController
{
    protected $hotelModel;
    protected $bookingModel;
    protected $complaintModel;

    public function __construct()
    {
        $this->hotelModel = new HotelModel();
        $this->bookingModel = new BookingModel();
        $this->complaintModel = new ComplaintModel();
    }

    // Dashboard admin hotel
    public function dashboard()
    {
        $hotelId = $this->getAdminHotelId(); // Method untuk mendapatkan hotel_id yang dikelola admin

        $data = [
            'title' => 'Dashboard Admin',
            'bookings' => $this->bookingModel->where('hotel_id', $hotelId)->findAll(),
            'complaints' => $this->complaintModel->where('hotel_id', $hotelId)->findAll()
        ];

        return view('admin/dashboard', $data);
    }

    // Update status pemesanan
    public function updateBookingStatus($bookingId)
    {
        $rules = [
            'status' => 'required|in_list[pending,confirmed,cancelled,completed]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', 'Status tidak valid');
        }

        $this->bookingModel->update($bookingId, [
            'status' => $this->request->getPost('status')
        ]);

        return redirect()->back()->with('message', 'Status berhasil diperbarui');
    }

    private function getAdminHotelId()
    {
        // Asumsi admin hanya mengelola 1 hotel
        $hotel = $this->hotelModel->where('admin_id', session()->get('userId'))->first();
        return $hotel['id'] ?? null;
    }
}
```

## **5. SuperAdminController (Super Admin)**

**File:** `app/Controllers/Admin/SuperAdminController.php`

```php
<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\CityModel;
use App\Models\CategoryModel;

class SuperAdminController extends BaseController
{
    protected $userModel;
    protected $cityModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->cityModel = new CityModel();
        $this->categoryModel = new CategoryModel();
    }

    // Kelola admin hotel
    public function manageHotelAdmins()
    {
        $data = [
            'title' => 'Kelola Admin Hotel',
            'admins' => $this->userModel->where('role', 'hotel')->findAll(),
            'hotels' => $this->hotelModel->findAll()
        ];

        return view('admin/super/manage_admins', $data);
    }

    // Tambah admin baru
    public function createAdmin()
    {
        $rules = [
            'hotel_id' => 'required|numeric',
            'email' => 'required|valid_email|is_unique[users.email]',
            'full_name' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->save([
            'email' => $this->request->getPost('email'),
            'full_name' => $this->request->getPost('full_name'),
            'password' => password_hash('password123', PASSWORD_DEFAULT), // Password default
            'role' => 'hotel'
        ]);

        // Assign hotel ke admin
        $adminId = $this->userModel->getInsertID();
        $this->hotelModel->update($this->request->getPost('hotel_id'), ['admin_id' => $adminId]);

        return redirect()->back()->with('message', 'Admin berhasil ditambahkan');
    }

    // Kelola kota
    public function manageCities()
    {
        $data = [
            'title' => 'Kelola Kota',
            'cities' => $this->cityModel->findAll()
        ];

        return view('admin/super/manage_cities', $data);
    }
}
```

## **6. ProfileController (Profil User)**

**File:** `app/Controllers/ProfileController.php`

```php
<?php namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Tampilkan profil
    public function index()
    {
        $user = $this->userModel->find(session()->get('userId'));

        return view('profile/index', [
            'title' => 'Profil Saya',
            'user' => $user
        ]);
    }

    // Update profil
    public function update()
    {
        $rules = [
            'full_name' => 'required',
            'phone' => 'permit_empty|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->update(session()->get('userId'), [
            'full_name' => $this->request->getPost('full_name'),
            'phone' => $this->request->getPost('phone')
        ]);

        return redirect()->back()->with('message', 'Profil berhasil diperbarui');
    }

    // Update foto profil
    public function updatePhoto()
    {
        $file = $this->request->getFile('photo');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/profiles', $newName);

            $this->userModel->update(session()->get('userId'), [
                'photo' => $newName
            ]);
        }

        return redirect()->back()->with('message', 'Foto profil berhasil diperbarui');
    }
}
```

## **Struktur Folder Controller**

```
/app
  /Controllers
    - AuthController.php
    - HotelController.php
    - BookingController.php
    - ProfileController.php
    /Admin
      - AdminController.php       # Untuk admin hotel
      - SuperAdminController.php # Untuk super admin
```

## **Langkah Implementasi**

1. Buat semua controller menggunakan CLI:

    ```bash
    php spark make:controller AuthController
    php spark make:controller HotelController
    php spark make:controller BookingController
    php spark make:controller ProfileController
    php spark make:controller Admin/AdminController
    php spark make:controller Admin/SuperAdminController
    ```

2. Copy isi controller dari contoh di atas

3. Sesuaikan dengan kebutuhan spesifik Anda

4. Buat view yang sesuai untuk setiap method controller

## **Tips Penting**

1. **Gunakan Validasi** di setiap input form
2. **Error Handling** selalu gunakan try-catch untuk operasi database
3. **Flash Message** untuk feedback ke user
4. **Pagination** untuk data yang banyak
5. **Middleware** untuk proteksi route (misal: admin-only)

Mau saya detailkan controller tertentu lebih dalam? Atau ada bagian spesifik yang ingin disesuaikan?
