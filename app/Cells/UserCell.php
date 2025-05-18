<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;
use App\Models\UserModel;

class UserCell extends Cell
{
    protected $user;

    public function mount()
    {
        $session = session();
        $userId = $session->get('user_id');

        if ($userId) {
            $this->user = (new UserModel())->find($userId);
        }
    }

    public function photo()
    {
        if (!isset($this->user) || empty($this->user['photo'])) {
            return base_url('dummy/person.png');
        }

        return base_url('uploads/profiles/' . $this->user['photo']);
    }

    public function fullName()
    {
        return $this->user['full_name'] ?? 'Pengguna';
    }

    public function email()
    {
        return $this->user['email'] ?? '-';
    }
}
