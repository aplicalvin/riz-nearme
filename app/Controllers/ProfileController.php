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