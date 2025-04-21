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