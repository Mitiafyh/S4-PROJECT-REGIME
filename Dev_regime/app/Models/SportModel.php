<?php

namespace App\Models;

use CodeIgniter\Model;

class SportModel extends Model
{
    protected $table = 'Activite_Physique';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = false;

    protected $allowedFields = [
          'type',
          'duree',
          'repetition',
          'depense_calorique',
          'image',
    ];

    public function getAll(): array
    {
        return $this->findAll();
    }
}
