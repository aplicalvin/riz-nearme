<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoomGalleryModel;
use App\Models\RoomTypeModel;

class RoomGalleryController extends BaseController
{
    protected $roomGalleryModel;
    protected $roomTypeModel;

    public function __construct()
    {
        $this->roomGalleryModel = new RoomGalleryModel();
        $this->roomTypeModel = new RoomTypeModel();

        $this->datahotel = new \App\Models\HotelModel();
        $this->admin_id = session()->get('user_id');
        $this->hotel_id = $this->datahotel->getHotelID($this->admin_id);
    }

    public function index($roomTypeId)
    {
        $room = $this->roomTypeModel->find($roomTypeId);
        // dd($this->admin_id);

        if (!$room || $room['hotel_id'] != $this->hotel_id['id']) {
            return redirect()->back()->with('error', 'Kamar tidak ditemukan atau tidak diakses');
        }

        $data = [
            'title' => 'Galeri Kamar: ' . $room['name'],
            'room' => $room,
            'photos' => $this->roomGalleryModel->getPhotosByRoom($roomTypeId),
            'validation' => \Config\Services::validation()
        ];
        // dd($data);
        return view('admin/rooms/v_gallery', $data);
    }

    public function upload($roomTypeId)
    {
        $rules = [
            'photo' => 'uploaded[photo]|is_image[photo]|max_size[photo,1024]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $photo = $this->request->getFile('photo');
        $photoName = $photo->getRandomName();
        $photo->move(FCPATH . 'uploads/room_gallery', $photoName);

        $this->roomGalleryModel->save([
            'room_type_id' => $roomTypeId,
            'photo' => $photoName
        ]);

        return redirect()->back()->with('message', 'Foto berhasil ditambahkan ke galeri kamar');
    }

    public function delete($id)
    {
        $photo = $this->roomGalleryModel->find($id);
        if ($photo && file_exists(FCPATH . 'uploads/room_gallery/' . $photo['photo'])) {
            unlink(FCPATH . 'uploads/room_gallery/' . $photo['photo']);
        }
        $this->roomGalleryModel->delete($id);
        return redirect()->back()->with('message', 'Foto galeri berhasil dihapus');
    }
}
