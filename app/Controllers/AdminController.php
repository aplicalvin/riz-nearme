<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HotelModel;
use App\Models\RoomTypeModel;
use App\Models\BookingModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    
    protected $hotel_id;
    protected $admin_id;
    
    public function __construct() {
        $this->datahotel = new HotelModel();
        $this->datakamar = new RoomTypeModel();
        $this->databooking = new BookingModel();
        $this->admin_id = session()->get('user_id'); 
        $this->hotel_id =  $this->datahotel->getHotelID($this->admin_id);
        
    }
    public function index()
    {
        if (!$this->admin_id) {
            return redirect()->to('/login');
        }

        $data = [
            'judul' => 'Dashboard Admin',
            'hotels' => $this->datahotel->getHotelData($this->hotel_id),
            'stats' => [
                'total_rooms' => $this->datakamar->getHotelCount($this->hotel_id),
                'available_rooms' => $this->datakamar->getAvailableRoomsCount($this->hotel_id),
                'total_bookings' => $this->databooking->getBookCount($this->hotel_id),
                'today_bookings' => $this->databooking->getTodayBookings($this->hotel_id),
                'active_bookings' => $this->databooking->getActiveBookings($this->hotel_id)
            ]
        ];

        return view('admin/v_dashboard', $data);
    }
    
// Di AdminController.php

public function room()
{
    $data = [
        'title' => 'Kelola Kamar',
        'rooms' => $this->datakamar->where('hotel_id', $this->hotel_id)->findAll()
    ];
    return view('admin/rooms/v_index', $data);
}

public function addRoom()
{
    $data = [
        'title' => 'Tambah Kamar Baru',
        'validation' => \Config\Services::validation()
    ];
    return view('admin/rooms/v_add', $data);
}

public function saveRoom()
{
    // Validasi
    $rules = [
        'name' => 'required|min_length[3]|max_length[100]',
        'description' => 'permit_empty',
        'base_price' => 'required|numeric',
        'capacity' => 'required|numeric',
        'available_rooms' => 'required|numeric',
        'photo' => 'uploaded[photo]|is_image[photo]'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Upload foto
    $photo = $this->request->getFile('photo');
    $photoName = $photo->getRandomName();
    $photo->move(FCPATH . 'uploads/rooms', $photoName);

    // Simpan data
    $data = [
        'hotel_id' => $this->hotel_id,
        'name' => $this->request->getPost('name'),
        'description' => $this->request->getPost('description'),
        'base_price' => $this->request->getPost('base_price'),
        'capacity' => $this->request->getPost('capacity'),
        'available_rooms' => $this->request->getPost('available_rooms'),
        'photo' => $photoName
    ];

    if ($this->datakamar->save($data)) {
        return redirect()->to('/admin/rooms')->with('message', 'Kamar berhasil ditambahkan');
    } else {
        return redirect()->back()->with('error', 'Gagal menambahkan kamar');
    }
}

public function editRoom($id)
{
    $room = $this->datakamar->find($id);
    // dd($room['hotel_id'] != $this->hotel_id['id'] );
    
    if (!$room || $room['hotel_id'] != $this->hotel_id['id']) {
        return redirect()->to('/admin/rooms')->with('error', 'Kamar tidak ditemukan');
    }

    $data = [
        'title' => 'Edit Kamar',
        'room' => $room,
        'validation' => \Config\Services::validation()
    ];
    return view('admin/rooms/v_edit', $data);
}

public function updateRoom($id)
{
    $room = $this->datakamar->find($id);
    
    if (!$room || $room['hotel_id'] != $this->hotel_id['id']) {
        return redirect()->to('/admin/rooms')->with('error', 'Kamar tidak ditemukan');
    }

    // Validasi
    $rules = [
        'name' => 'required|min_length[3]|max_length[100]',
        'description' => 'permit_empty',
        'base_price' => 'required|numeric',
        'capacity' => 'required|numeric',
        'available_rooms' => 'required|numeric',
        'photo' => 'is_image[photo]'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Handle photo upload
    $photo = $this->request->getFile('photo');
    $data = [
        'name' => $this->request->getPost('name'),
        'description' => $this->request->getPost('description'),
        'base_price' => $this->request->getPost('base_price'),
        'capacity' => $this->request->getPost('capacity'),
        'available_rooms' => $this->request->getPost('available_rooms')
    ];

    if ($photo->isValid() && !$photo->hasMoved()) {
        // Hapus foto lama
        if ($room['photo'] && file_exists(FCPATH . 'uploads/rooms/' . $room['photo'])) {
            unlink(FCPATH . 'uploads/rooms/' . $room['photo']);
        }
        
        // Upload foto baru
        $photoName = $photo->getRandomName();
        $photo->move(FCPATH . 'uploads/rooms', $photoName);
        $data['photo'] = $photoName;
    }

    if ($this->datakamar->update($id, $data)) {
        return redirect()->to('/admin/rooms')->with('message', 'Kamar berhasil diperbarui');
    } else {
        return redirect()->back()->with('error', 'Gagal memperbarui kamar');
    }
}

public function deleteRoom($id)
{
    $room = $this->datakamar->find($id);
    
    if (!$room || $room['hotel_id'] != $this->hotel_id) {
        return redirect()->to('/admin/rooms')->with('error', 'Kamar tidak ditemukan');
    }

    // Hapus foto
    if ($room['photo'] && file_exists(FCPATH . 'uploads/rooms/' . $room['photo'])) {
        unlink(FCPATH . 'uploads/rooms/' . $room['photo']);
    }

    if ($this->datakamar->delete($id)) {
        return redirect()->to('/admin/rooms')->with('message', 'Kamar berhasil dihapus');
    } else {
        return redirect()->back()->with('error', 'Gagal menghapus kamar');
    }
}
    
    public function booking()
    {
        //
        $data = [
            'bookings' => $this->databooking->getHotelBookings($this->hotel_id)
        ];

        // dd($data);
        return view('admin/v_booking', $data);
    }
    
    // update status booking
    public function updateStatus()
    {
        // Debug: Cek data yang dikirim
        // dd($this->request->getPost());

        $validation = \Config\Services::validation();
        $validation->setRules([
            'booking_id' => 'required|numeric',
            'status' => 'required|in_list[pending,confirmed,cancelled,completed,no_show]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->with('error', 'Input tidak valid: ' . implode(', ', $validation->getErrors()))
                ->withInput();
        }

        $bookingId = $this->request->getPost('booking_id');
        $newStatus = $this->request->getPost('status');

        try {
            // Gunakan method model yang benar
            $updated = $this->databooking->updateBookingStatus($bookingId, $newStatus);
            
            if ($updated) {
                log_message('info', "Status booking {$bookingId} diubah ke {$newStatus}");
                return redirect()->back()
                    ->with('message', 'Status booking berhasil diperbarui');
            }
            
            return redirect()->back()
                ->with('error', 'Gagal memperbarui status booking');
                
        } catch (\Exception $e) {
            log_message('error', 'Error updating booking: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // VIEW DATA VIA SETTING
    public function setting()
    {
        $data = [
            'title' => 'Hotel Settings',
            'datahotel' => $this->datahotel->getHotelData($this->hotel_id),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/v_setting', $data);
    }

    // UPDATE HOTEL DATA VIA SETTING
    public function updateHotelData()
    {
        // Validasi input
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'description' => 'permit_empty|max_length[500]',
            'address' => 'required',
            'star_rating' => 'permit_empty|numeric|less_than_equal_to[5]',
            'cover_photo' => [
                'rules' => 'is_image[cover_photo]|mime_in[cover_photo,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'File harus berupa gambar',
                    'mime_in' => 'Format gambar tidak didukung'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data dari form
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'address' => $this->request->getPost('address'),
            'star_rating' => $this->request->getPost('star_rating')
        ];

        // Handle file upload
        $coverPhoto = $this->request->getFile('cover_photo');
        if ($coverPhoto->isValid() && !$coverPhoto->hasMoved()) {
            // Hapus foto lama jika ada
            $oldPhoto = $this->datahotel->getHotelData($this->hotel_id)['cover_photo'];
            if ($oldPhoto && file_exists(FCPATH . 'uploads/hotels/' . $oldPhoto)) {
                unlink(FCPATH . 'uploads/hotels/' . $oldPhoto);
            }

            // Generate nama file baru
            $newName = $coverPhoto->getRandomName();
            $coverPhoto->move(FCPATH . 'uploads/hotels', $newName);
            $data['cover_photo'] = $newName;
        }

        try {
            $updated = $this->datahotel->update($this->hotel_id, $data);
            
            if ($updated) {
                return redirect()->to('/admin/setting')->with('message', 'Data hotel berhasil diperbarui');
            } else {
                return redirect()->back()->with('error', 'Gagal memperbarui data hotel');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
