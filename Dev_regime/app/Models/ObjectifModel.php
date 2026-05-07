<?php
namespace App\Models;

use CodeIgniter\Model;

class ObjectifModel extends Model
{
	protected $table = 'Objectif';
	protected $primaryKey = 'id';
	protected $allowedFields = [];

	/**
	 * Retourne tous les objectifs
	 * @return array
	 */
	public function getAll(): array
	{
		return $this->findAll();
	}
}
