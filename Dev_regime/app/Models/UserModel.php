<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'User';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username',
        'email',
        'password',
        'role',
        'modeGold',
        'argent'
    ];

    public function getUserById($id)
    {
        return $this->find($id);
    }
    public function activeGold($userId)
    {
        $user = $this->find($userId);
        if ($user && !$user['modeGold'] && $user['argent'] >= 10000) {
            $this->update($userId, [
                'modeGold' => true,
                'argent' => $user['argent'] - 10000
            ]);
            return true;
        }
        return false;
    }

}