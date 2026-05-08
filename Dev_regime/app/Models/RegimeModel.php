<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimeModel extends Model
{
    protected $table = 'Regime';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = false;

    protected $allowedFields = [
        'Pourcentage_viande',
        'Pourcentage_poisson',
        'Pourcentage_volaille',
        'constatation',
        'prixParSemaine',
        'image',
    ];

    public function getAll(): array
    {
        return $this->findAll();
    }
}
