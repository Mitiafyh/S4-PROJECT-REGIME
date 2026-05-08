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
    
}