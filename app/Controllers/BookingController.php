<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\PaymentMethodModel;
use App\Models\RoomTypeModel;
use function PHPUnit\Framework\returnArgument;

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

    // Menampilkan form pemesanan
    public function new($hotelId, $roomTypeId = null)
    {
        // Validasi session/user
        if (!session()->get('user_id')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu untuk melakukan pemesanan');
        }

        // Dapatkan data kamar
        $roomTypes = $this->roomTypeModel->where('hotel_id', $hotelId)->findAll();
        
        if (empty($roomTypes)) {
            return redirect()->back()->with('error', 'Tidak ada kamar tersedia untuk hotel ini');
        }

        // Jika ada roomTypeId, set sebagai kamar yang dipilih
        $selectedRoom = null;
        if ($roomTypeId) {
            $selectedRoom = $this->roomTypeModel->find($roomTypeId);
        }

        // Dapatkan metode pembayaran yang aktif
        $paymentMethods = $this->paymentMethodModel->where('is_active', 1)->findAll();

        $data = [
            'title' => 'Form Pemesanan',
            'roomTypes' => $roomTypes,
            'selectedRoom' => $selectedRoom,
            'hotelId' => $hotelId,
            'paymentMethods' => $paymentMethods,
            'validation' => \Config\Services::validation()
        ];

        return view('booking/v_booking_form', $data);
    }

    // Proses pemesanan
    public function create()
    {
        // Validasi input
        $rules = [
            'hotel_id' => 'required|numeric',
            'room_type_id' => 'required|numeric',
            'check_in_date' => 'required|valid_date',
            'check_out_date' => 'required|valid_date',
            'adults' => 'required|numeric|greater_than[0]',
            'children' => 'numeric',
            'payment_method_id' => 'required|numeric',
            'special_requests' => 'permit_empty|string'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Hitung total harga
        $roomType = $this->roomTypeModel->find($this->request->getPost('room_type_id'));
        $checkIn = new \DateTime($this->request->getPost('check_in_date'));
        $checkOut = new \DateTime($this->request->getPost('check_out_date'));
        $nights = $checkOut->diff($checkIn)->days;
        $totalPrice = $nights * $roomType['base_price'];

        // Simpan data pemesanan
        $bookingData = [
            'user_id' => session()->get('user_id'),
            'hotel_id' => $this->request->getPost('hotel_id'),
            'room_type_id' => $this->request->getPost('room_type_id'),
            'payment_method_id' => $this->request->getPost('payment_method_id'),
            'check_in_date' => $this->request->getPost('check_in_date'),
            'check_out_date' => $this->request->getPost('check_out_date'),
            'adults' => $this->request->getPost('adults'),
            'children' => $this->request->getPost('children') ?? 0,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_status' => 'pending',
            'special_requests' => $this->request->getPost('special_requests')
        ];

        // Cek ketersediaan kamar
        if (!$this->bookingModel->isRoomAvailable(
            $bookingData['room_type_id'],
            $bookingData['check_in_date'],
            $bookingData['check_out_date']
        )) {
            return redirect()->back()->withInput()->with('error', 'Kamar tidak tersedia untuk tanggal yang dipilih');
        }

        // Simpan booking
        if ($this->bookingModel->save($bookingData)) {
            return redirect()->to('/user/bookings')->with('success', 'Pemesanan berhasil dibuat!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal membuat pemesanan. Silakan coba lagi.');
        }
    }

    // Menampilkan detail booking
    public function show($id)
    {
        $booking = $this->bookingModel->getBookingDetail($id);
        
        if (!$booking || $booking['user_id'] != session()->get('user_id')) {
            return redirect()->to('/user/bookings')->with('error', 'Pemesanan tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Pemesanan',
            'booking' => $booking
        ];

        return view('booking/v_booking_detail', $data);
    }

    // Upload bukti pembayaran
    public function uploadPayment($id)
    {
        $booking = $this->bookingModel->find($id);
        
        // Validasi kepemilikan booking
        if (!$booking || $booking['user_id'] != session()->get('user_id')) {
            return redirect()->to('/user/bookings')->with('error', 'Pemesanan tidak ditemukan');
        }

        // Validasi file upload
        $validation = $this->validate([
            'payment_proof' => [
                'rules' => 'uploaded[payment_proof]|max_size[payment_proof,2048]|is_image[payment_proof]',
                'errors' => [
                    'uploaded' => 'Harap pilih file bukti pembayaran',
                    'max_size' => 'Ukuran file maksimal 2MB',
                    'is_image' => 'File harus berupa gambar (JPG, JPEG, PNG)'
                ]
            ]
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Upload file
        $file = $this->request->getFile('payment_proof');
        $newName = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads/payments', $newName);

        // Update booking
        $this->bookingModel->update($id, [
            'payment_proof' => $newName,
            'payment_status' => 'pending' // Kembali ke pending untuk diverifikasi admin
        ]);

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah. Silakan tunggu verifikasi.');
    }

    public function cancel($id)
    {
        $detail = $this->bookingModel->getBookingDetail($id);
        // dd($detail['status']);

        if ($detail['status'] == 'pending') {
            $this->bookingModel->updateBookingStatus($id, 'cancelled');
            // $this->bookingModel->updatePaymentStatus($id, 'failed');
            return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');

        } else {
             $errorMessage = 'Gagal membatalkan pesanan.';
            if (!$detail) {
                $errorMessage = 'Detail pesanan tidak ditemukan.';
            } elseif ($detail['status'] != 'pending') {
                $errorMessage = 'Pesanan tidak dapat dibatalkan karena statusnya bukan "pending" (Status saat ini: ' . $detail['status'] . ').';
            }
            // Mengarahkan kembali ke halaman sebelumnya dengan pesan gagal
            return redirect()->back()->with('failed', $errorMessage);
        }

    }
}