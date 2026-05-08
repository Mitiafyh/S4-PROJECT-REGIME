<?php

namespace App\Controllers;

use App\Models\UserModel;

class WalletController extends BaseController
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
        
        // Obtenir l'historique des achats de régimes
        $purchases = $db->table('Regime_Activite_User_Objectif as ruao')
            ->select('ruao.id, ruao.regime_id, ruao.created_at, r.nom, r.prixParSemaine')
            ->join('Regime r', 'r.id = ruao.regime_id')
            ->where('ruao.user_id', $userId)
            ->orderBy('ruao.created_at', 'DESC')
            ->get()
            ->getResult();

        return view('users/wallet', [
            'user' => $user,
            'purchases' => $purchases,
        ]);
    }

    public function applyPromoCode()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter.');
        }

        $code = trim($this->request->getPost('code'));

        if (empty($code)) {
            return redirect()->back()->with('error', 'Veuillez entrer un code promo.');
        }

        $db = \Config\Database::connect();
        
        $promoCode = $db->table('Codes')
            ->where('code', $code)
            ->where('status', 'active')
            ->get()
            ->getRowArray();

        if (!$promoCode) {
            return redirect()->back()->with('error', 'Code promo invalide ou expiré.');
        }

        $creditAmount = 50;

        $userModel = new UserModel();
        $user = $userModel->getUserById($userId);
        $newBalance = ((float) $user['argent'] ?? 0) + $creditAmount;

        $userModel->update($userId, ['argent' => $newBalance]);

        $db->table('Codes')->update($promoCode['id'], ['status' => 'used']);

        return redirect()->back()->with('success', "Code accepté ! +{$creditAmount}€ ajoutés à votre compte.");
    }

    public function activateGold()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter.');
        }

        $userModel = new UserModel();
        $user = $userModel->getUserById($userId);

        $goldPrice = 10000.00;

        if (((float) $user['argent'] ?? 0) < $goldPrice) {
            return redirect()->back()->with('error', 'Solde insuffisant. Vous avez besoin de ' . number_format($goldPrice, 0, ',', '.') . ' Ar.');
        }

        $newBalance = ((float) $user['argent'] ?? 0) - $goldPrice;
        $userModel->update($userId, [
            'argent' => $newBalance,
            'modeGold' => true
        ]);

        return redirect()->back()->with('success', 'Mode Gold activé ! Profitez de 15% de réduction.');
    }
}
