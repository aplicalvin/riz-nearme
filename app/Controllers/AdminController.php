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
        
        // Validate if admin is logged in
        if (!$this->admin_id) {
            return redirect()->to('/login'); // Redirect to login if not authenticated
        }

        $data = [
            'judul' => 'Dashboard Admin',
            'hotels' => $this->datahotel->getHotelData($this->hotel_id) 
        ];

        // $admin_id->

        return view('admin/v_dashboard', $data);
    }
    
    public function room()
    {
        //
        $data = [
            'rooms' => $this->datakamar->getRoomData($this->hotel_id)
        ];

        // dd($data);
        return view('admin/v_room', $data);
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

    public function setting()
    {
        //
        return view('admin/v_setting');
    }
    
}
