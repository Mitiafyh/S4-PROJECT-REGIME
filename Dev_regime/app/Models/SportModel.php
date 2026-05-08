<?php

namespace App\Models;

use CodeIgniter\Model;
// CREATE TABLE Activite_Physique(
//     id int AUTO_INCREMENT PRIMARY KEY,
//     type varchar(255) NOT NULL,
//     duree int NOT NULL,
//     repetition int NOT NULL,
//     depense_calorique int NOT NULL,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// );
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
