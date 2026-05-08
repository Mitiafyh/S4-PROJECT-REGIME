<?php

namespace App\Models;
use CodeIgniter\Model;

class RegimeModel extends Model
{
    protected $table = 'Regime';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'pourcentage_viande',
        'pourcentage_poisson',
        'pourcentage_volaille',
        'constatation',
        'prixParSemaine',
        'image'
    ];
    public function getRegimesByObjectifId($objectifId, $userId = null)
    {
        if ($objectifId == 1) {
            return $this->where('constatation <', 0)->findAll();
        }

        if ($objectifId == 2) {
            return $this->where('constatation >', 0)->findAll();
        }

        if ($objectifId == 3 && $userId !== null) {
            $infoSante = $this->db->table('Info_Sante')
                ->where('user_id', $userId)
                ->get()
                ->getRowArray();

            if ($infoSante && (float) $infoSante['taille'] > 0) {
                $imc = (float) $infoSante['poids'] / ((float) $infoSante['taille'] * (float) $infoSante['taille']);

                if ($imc > 24.9) {
                    return $this->where('constatation <', 0)->findAll();
                }

                if ($imc < 18.5) {
                    return $this->where('constatation >', 0)->findAll();
                }

                return $this->findAll();
            }
        }

        return $this->findAll();
    }
}