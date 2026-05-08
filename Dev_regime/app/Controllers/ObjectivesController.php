<?php

namespace App\Controllers;

use App\Models\UserModel;

class ObjectivesController extends BaseController
{
    public function index()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter.');
        }

        $userModel = new UserModel();
        $user = $userModel->getUserById($userId);

        $db = \Config\Database::connect();
        $infoSante = $db->table('Info_Sante')
            ->where('user_id', $userId)
            ->get()
            ->getRowArray();

        // Calculer l'IMC
        $imc = null;
        if ($infoSante && $infoSante['poids'] && $infoSante['taille']) {
            // taille est déjà en mètres (ex: 1.70) depuis Info_Sante
            $imc = round($infoSante['poids'] / ($infoSante['taille'] * $infoSante['taille']), 1);
        }

        $objectifId = $session->get('objectif_id');
        if (!$objectifId && !empty($infoSante)) {
            $lastChoice = $db->table('Regime_Activite_User_Objectif')
                ->select('objectif_id')
                ->where('user_id', $userId)
                ->orderBy('id', 'DESC')
                ->get()
                ->getRowArray();

            if (!empty($lastChoice['objectif_id'])) {
                $objectifId = (int) $lastChoice['objectif_id'];
            }
        }

        // Obtenir les information de l'objectif sélectionné
        $objectif = null;
        if ($objectifId) {
            $objectif = $db->table('Objectif')->where('id', $objectifId)->get()->getRowArray();
        }

        $objectifs = $db->table('Objectif')->get()->getResult();

        return view('users/objectives', [
            'user' => $user,
            'infoSante' => $infoSante,
            'imc' => $imc,
            'objectifId' => $objectifId,
            'objectif' => $objectif,
            'objectifs' => $objectifs,
        ]);
    }

    public function saveObjective()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter.');
        }

        $poids = $this->request->getPost('poids');
        $taille = $this->request->getPost('taille');
        $objectifId = $this->request->getPost('objectif');

        if (empty($poids) || empty($taille) || empty($objectifId)) {
            return redirect()->back()->with('error', 'Tous les champs doivent être remplis.');
        }

        $db = \Config\Database::connect();

        $db->table('Info_Sante')->updateBatch([
            [
                'user_id' => $userId,
                'poids' => $poids,
                'taille' => $taille,
            ]
        ], 'user_id');

        $session->set('objectif_id', (int) $objectifId);

        return redirect()->back()->with('success', 'Vos objectifs ont été mis à jour !');
    }
}
