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