<?php

namespace App\Models;

use CodeIgniter\Model;

class CodesModel extends Model
{
    protected $table = 'Codes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'code',
        'status',
    ];

    public function getValidCode($code)
    {
        return $this->where('code', $code)
            ->where('status', 'active')
            ->first();
    }

    public function markAsUsed($codeId)
    {
        return $this->update($codeId, ['status' => 'used']);
    }
}
