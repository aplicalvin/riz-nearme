<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BookingModel;
use App\Models\FavoriteModel;

class UserController extends BaseController
{
    protected $userModel;
    protected $bookingModel;
    protected $favoriteModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->bookingModel = new BookingModel();
        $this->favoriteModel = new FavoriteModel();
        
        // Pastikan user sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
    }

    // Halaman Profil
    public function profile()
    {
        $data = [
            'title' => 'Profil Saya',
            'judul' => 'Profil Saya - ',
            'user' => $this->userModel->find(session()->get('user_id')),
            'activeTab' => 'profile'
        ];
        return view('user/profile_content', $data);
    }

    // Form Edit Profil
    public function editProfile()
    {
        $data = [
            'title' => 'Edit Profil',
            'user' => $this->userModel->find(session()->get('user_id')),
            'activeTab' => 'profile'
        ];
        return view('user/edit_profile', $data);
    }

    // Proses Update Profil
    public function updateProfile()
    {
        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        $rules = [
            'full_name' => 'required|min_length[3]',
            'phone' => 'permit_empty|numeric|min_length[10]',
            'photo' => 'uploaded[photo]|is_image[photo]|max_size[photo,2048]' // 2MB max
        ];

        // Foto optional: ubah rules jika tidak upload
        if (!$this->request->getFile('photo')->isValid()) {
            unset($rules['photo']);
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'phone' => $this->request->getPost('phone')
        ];

        $photo = $this->request->getFile('photo');
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $newName = $photo->getRandomName();
            $photo->move('uploads/profiles', $newName);
            $data['photo'] = $newName;

            // Hapus foto lama jika ada
            if (!empty($user['photo']) && file_exists('uploads/profiles/' . $user['photo'])) {
                unlink('uploads/profiles/' . $user['photo']);
            }

            // Update session photo jika sedang digunakan
            session()->set('photo', $newName);
        }

        $this->userModel->update($userId, $data);

        return redirect()->to('/user/profile')->with('success', 'Profil berhasil diperbarui');
    }


    // History Pemesanan
    public function bookings()
    {
        $bookings = $this->bookingModel->getUserBookings(session()->get('user_id'));

        $data = [
            'title' => 'History Pemesanan',
            'user' => $this->userModel->find(session()->get('user_id')), // <- Wajib ada
            'bookings' => $this->bookingModel->getUserBookings(session()->get('user_id')),
            'activeTab' => 'bookings'
        ];
        // dd($data);
        return view('user/bookings', $data);
    }

    // Hotel Favorit
    public function favorites()
    {
        $favorites = $this->favoriteModel->getUserFavorites(session()->get('user_id'));

        $data = [
            'title' => 'Hotel Favorit',
            'user' => $this->userModel->find(session()->get('user_id')), // <- Tambah ini
            'favorites' => $this->favoriteModel->getUserFavorites(session()->get('user_id')),
            'activeTab' => 'favorites'
        ];
        return view('user/favorites', $data);
    }

    public function showChangePasswordForm()
    {
         $data = [
            'title' => 'Profil Saya',
            'judul' => 'Profil Saya - ',
            'user' => $this->userModel->find(session()->get('user_id')),
            'activeTab' => 'profile'
        ];
        $user = $this->userModel->find(session()->get('user_id')); 
        // dd($user);
        if (!$user) { 
            return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu.');
        }
        return view('user/v_change_password', $data); // Tampilkan view form
    }

    public function changePasswordSubmit() // Tidak ada parameter $userId lagi
    {
        // Ambil user_id dari session. Pastikan key session Anda benar ('user_id', 'id', dll.)
        $userId = $this->userModel->find(session()->get('user_id')); 

        // Validasi apakah userId ada di session (seharusnya sudah ditangani oleh filter authGuard,
        // tapi double check tidak ada salahnya)
        if (!$userId) {
            // Jika karena suatu hal filter tidak berjalan atau user_id tidak ada
            return redirect()->to('/login')->with('error', 'Sesi tidak valid atau Anda belum login.');
        }

        // Ambil data dari POST request
        $currentPassword    = $this->request->getPost('current_password');
        $newPassword        = $this->request->getPost('new_password');
        $confirmNewPassword = $this->request->getPost('confirm_new_password');

        // Panggil metode model dengan $userId dari session
        $result = $this->userModel->changePassword($userId, $currentPassword, $newPassword, $confirmNewPassword);

        if ($result['success']) {
            // Opsional: Tindakan setelah berhasil ganti password
            // Misalnya, update data sesi jika ada info terkait keamanan, atau paksa login ulang.
            // $this->session->setFlashdata('success_message', 'Password berhasil diubah.'); // Gunakan setFlashdata
            return redirect()->to('/user/profile')->with('success', 'Password berhasil diubah.'); // Arahkan ke halaman profil
        } else {
            // $this->session->setFlashdata('error_messages', $result['errors']); // Gunakan setFlashdata untuk errors jika redirect
            return redirect()->back()->withInput()->with('errors', $result['errors']);
        }
    }

}