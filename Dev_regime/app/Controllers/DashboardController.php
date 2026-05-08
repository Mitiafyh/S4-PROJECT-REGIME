<?php

namespace App\Controllers;

use App\Models\ObjectifModel;
use App\Models\RegimeModel;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter.');
        }

        $userModel = new UserModel();
        $objectifModel = new ObjectifModel();
        $regimeModel = new RegimeModel();

        $user = $userModel->getUserById($userId);
        $db = \Config\Database::connect();
        $infoSante = $db->table('Info_Sante')->where('user_id', $userId)->get()->getRowArray();

        $objectifId = $session->get('objectif_id');
        if (!$objectifId) {
            $lastUserChoice = $db->table('Regime_Activite_User_Objectif')
                ->select('objectif_id')
                ->where('user_id', $userId)
                ->orderBy('id', 'DESC')
                ->get()
                ->getRowArray();

            if (!empty($lastUserChoice['objectif_id'])) {
                $objectifId = (int) $lastUserChoice['objectif_id'];
                $session->set('objectif_id', $objectifId);
            }
        }

        $objectif = $objectifId ? $objectifModel->find($objectifId) : null;

        $regimes = [];
        if ($objectifId) {
            $regimes = $regimeModel->getRegimesByObjectifId((int) $objectifId, (int) $userId);
        }

        $imc = null;
        $imcBarPercent = 0;
        if (!empty($infoSante['poids']) && !empty($infoSante['taille']) && (float) $infoSante['taille'] > 0) {
            // taille est déjà en mètres (ex: 1.70)
            $imc = round((float) $infoSante['poids'] / (((float) $infoSante['taille']) * ((float) $infoSante['taille'])), 1);
            $imcBarPercent = max(0, min(100, (($imc - 12) / (40 - 12)) * 100));
        }

        return view('users/dashboard', [
            'user' => $user,
            'objectif' => $objectif,
            'infoSante' => $infoSante,
            'regimes' => array_slice($regimes, 0, 3),
            'imc' => $imc,
            'imcBarPercent' => $imcBarPercent,
        ]);
    }
    
}
