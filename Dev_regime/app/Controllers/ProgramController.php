<?php

namespace App\Controllers;

use App\Models\ObjectifModel;
use App\Models\RegimeModel;
use App\Models\UserModel;

class ProgramController extends BaseController
{
    private function getSettingsData(): array
    {
        $db = \Config\Database::connect();
        $defaults = [
            'gold_discount' => 0.15,
            'general_currency' => 'Ar',
        ];

        $row = $db->table('Settings')->get()->getRowArray();
        if (!$row) {
            return $defaults;
        }

        return array_merge($defaults, $row);
    }

    public function index(){
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

        // Get all regimes for display and purchase
        $db = \Config\Database::connect();
        $allRegimes = $db->table('Regime')->get()->getResultArray();
        $userRegimeIds = $db->table('Regime_Activite_User_Objectif')
            ->where('user_id', $userId)
            ->select('regime_id')
            ->get()->getResultArray();
        $userRegimeIds = array_column($userRegimeIds, 'regime_id');
        $ownedRegimes = array_values(array_filter($allRegimes, function ($regime) use ($userRegimeIds) {
            return in_array($regime['id'], $userRegimeIds, true);
        }));

        $settings = $this->getSettingsData();

        return view("/users/program",[
            'user'=>$user,
            'objectif'=>$objectif,
            'regimes'=>$regimes,
            'allRegimes' => $allRegimes,
            'userRegimeIds' => $userRegimeIds,
            'ownedRegimes' => $ownedRegimes,
            'goldSettings' => $settings,
            ]);
    }

    public function buyRegime()
    {
        $userId = session()->get('user_id');
        if (!$userId) return redirect()->to('login');

        $regimeId = $this->request->getPost('regime_id');
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        $db = \Config\Database::connect();
        $regime = $db->table('Regime')->where('id', $regimeId)->get()->getRowArray();

        if (!$regime) {
            return redirect()->back()->with('error', 'Régime introuvable');
        }

        $price = (float) $regime['prixParSemaine'];
        $userBalance = (float) ($user['argent'] ?? 0);
        $settings = $this->getSettingsData();
        $discount = !empty($user['modeGold']) ? (float) ($settings['gold_discount'] ?? 0.15) : 0;
        $finalPrice = $price * (1 - $discount);

        if ($userBalance < $finalPrice) {
            return redirect()->back()->with('error', 'Solde insuffisant');
        }

        // Check if already purchased
        $alreadyOwned = $db->table('Regime_Activite_User_Objectif')
            ->where('user_id', $userId)
            ->where('regime_id', $regimeId)
            ->countAllResults() > 0;

        if ($alreadyOwned) {
            return redirect()->back()->with('error', 'Vous possédez déjà ce régime');
        }

        // Deduct balance
        $newBalance = $userBalance - $finalPrice;
        $userModel->update($userId, ['argent' => $newBalance]);

        $activityRow = $db->table('Activite_Physique')
            ->select('id')
            ->orderBy('id', 'ASC')
            ->get()
            ->getRowArray();

        if (empty($activityRow['id'])) {
            return redirect()->back()->with('error', 'Aucune activite disponible pour lier ce regime.');
        }

        // Save purchase
        $db->table('Regime_Activite_User_Objectif')->insert([
            'user_id' => $userId,
            'regime_id' => $regimeId,
            'activite_id' => (int) $activityRow['id'],
            'objectif_id' => session()->get('objectif_id') ?? 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $discountMessage = $discount > 0 ? ' (Reduction Gold: ' . round($discount * 100) . '%)' : '';
        return redirect()->back()->with('success', 'Regime achete avec succes!' . $discountMessage);
    }
}