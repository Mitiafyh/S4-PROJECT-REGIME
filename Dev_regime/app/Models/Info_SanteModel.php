<?php
namespace App\Models;

use CodeIgniter\Model;

class Info_SanteModel extends Model
{
	protected $table = 'Info_Sante';
	protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'poids',
        'taille',
        'genre',
    ];

	/**
	 * Retourne tous les objectifs
	 * @return array
	 */
	public function getAll(): array
	{
		return $this->findAll();
	}
    public function saveInfoSante($data)
    {
        $this->insert($data);
    }
    public function getInfoSanteByUserId($userId)
    {
        return $this->where('user_id', $userId)->first();
    }
    public function updateInfoSante($id, $data)
    {
        $this->update($id, $data);
    }
}
