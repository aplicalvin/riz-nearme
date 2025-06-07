<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HotelGalleryModel;
use App\Models\HotelModel;

class HotelGalleryController extends BaseController
{
    protected $hotelGalleryModel;
    protected $hotelModel;
    

    public function __construct()
    {
        $this->hotelModel = new HotelModel();
        $this->hotelGalleryModel = new \App\Models\HotelGalleryModel();
        
        // Ambil ID admin dari session
        $session = session();
        $this->admin_id = $session->get('user_id');

        // Ambil hotel_id dari admin yang sedang login
        $this->hotel_id = $this->hotelModel->getHotelID($this->admin_id);
    }
    
    /**
     * Show gallery management page
     */
    public function index()
    {
        // Ambil hotel berdasarkan hotel_id yang terkait dengan admin
        $hotel = $this->hotelModel->find($this->hotel_id);
        if (!$hotel) {
            return redirect()->back()->with('error', 'Hotel tidak ditemukan');
        }

        $data = [
            'title' => 'Kelola Galeri Hotel',
            'hotel' => $hotel,
            'photos' => $this->hotelGalleryModel->getPhotosByHotel($this->hotel_id),
            'validation' => \Config\Services::validation()
        ];
        // dd($data);
        return view('admin/v_hotel_gallery', $data);
    }

    
    /**
     * Upload new photo to gallery
     */
    public function upload($hotelId)
    {
        // Validation
        $rules = [
            'photo' => [
                'rules' => 'uploaded[photo]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih foto terlebih dahulu',
                    'is_image' => 'File harus berupa gambar',
                    'mime_in' => 'Format file harus JPG/JPEG/PNG'
                ]
            ]
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Get uploaded file
        $file = $this->request->getFile('photo');
        
        // Generate new name
        $newName = $file->getRandomName();
        
        // Move to uploads directory
        $file->move(ROOTPATH . 'public/uploads/galleries', $newName);
        
        // Save to database
        $this->hotelGalleryModel->addPhoto($hotelId, $newName);
        
        return redirect()->back()->with('success', 'Foto berhasil diupload');
    }
    
    /**
     * Delete photo from gallery
     */
    public function delete($id)
    {
        $photo = $this->hotelGalleryModel->find($id);
        if (!$photo) {
            return redirect()->back()->with('error', 'Foto tidak ditemukan');
        }
        
        // Verify hotel ownership/management
        $hotel = $this->hotelModel->find($photo['hotel_id']);
        if (!$hotel) {
            return redirect()->back()->with('error', 'Hotel tidak ditemukan');
        }
        
        // Delete photo
        if ($this->hotelGalleryModel->deletePhoto($id)) {
            return redirect()->back()->with('success', 'Foto berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus foto');
        }
    }
}