<?php

namespace App\Controllers;

use App\Models\UserModel;

class ActivitiesController extends BaseController
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
        
        // Obtenir toutes les activités disponibles
        $allActivities = $db->table('Activite_Physique')->get()->getResult();
        
        // Obtenir les activités sélectionnées par l'utilisateur
        $userActivities = $db->table('Regime_Activite_User_Objectif')
            ->distinct()
            ->select('activite_id')
            ->where('user_id', $userId)
            ->get()
            ->getResult();
        
        $userActivityIds = array_column((array) $userActivities, 'activite_id');

        return view('users/activities', [
            'user' => $user,
            'allActivities' => $allActivities,
            'userActivityIds' => $userActivityIds,
        ]);
    }
}
