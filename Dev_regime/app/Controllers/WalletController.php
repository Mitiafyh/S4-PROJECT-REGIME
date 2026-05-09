<?php

namespace App\Controllers;

use App\Models\UserModel;

class WalletController extends BaseController
{
    private function getSettingsData(): array
    {
        $db = \Config\Database::connect();
        $defaults = [
            'gold_discount' => 0.15,
            'gold_price' => 10000,
            'gold_currency' => 'Ar',
            'promo_default_value' => 50,
            'promo_bonus_percent' => 0,
            'low_balance_threshold' => 0,
            'general_currency' => 'Ar',
        ];

        $row = $db->table('Settings')->get()->getRowArray();
        if (!$row) {
            return $defaults;
        }

        return array_merge($defaults, $row);
    }

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

        $settings = $this->getSettingsData();

        return view('users/wallet', [
            'user' => $user,
            'purchases' => $purchases,
            'goldSettings' => $settings,
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

        $settings = $this->getSettingsData();
        $baseCredit = isset($promoCode['valeur']) ? (float) $promoCode['valeur'] : (float) ($settings['promo_default_value'] ?? 50);
        $promoBonusPercent = (float) ($settings['promo_bonus_percent'] ?? 0);
        $creditAmount = $baseCredit + ($baseCredit * ($promoBonusPercent / 100));

        $userModel = new UserModel();
        $user = $userModel->getUserById($userId);
        $newBalance = ((float) $user['argent'] ?? 0) + $creditAmount;

        $userModel->update($userId, ['argent' => $newBalance]);

        $db->table('Codes')
            ->where('id', (int) $promoCode['id'])
            ->update(['status' => 'used']);

        $currency = (string) ($settings['general_currency'] ?? 'Ar');
        return redirect()->back()->with('success', "Code accepte ! +" . number_format($creditAmount, 2, '.', '') . "{$currency} ajoutes a votre compte.");
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

        $settings = $this->getSettingsData();
        $goldPrice = (float) ($settings['gold_price'] ?? 10000);
        $goldCurrency = (string) ($settings['gold_currency'] ?? 'Ar');
        $goldDiscount = (float) ($settings['gold_discount'] ?? 0.15);

        if (((float) $user['argent'] ?? 0) < $goldPrice) {
            return redirect()->back()->with('error', 'Solde insuffisant. Vous avez besoin de ' . number_format($goldPrice, 0, ',', '.') . ' ' . $goldCurrency . '.');
        }

        $newBalance = ((float) $user['argent'] ?? 0) - $goldPrice;
        $userModel->update($userId, [
            'argent' => $newBalance,
            'modeGold' => true
        ]);

        return redirect()->back()->with('success', 'Mode Gold active ! Profitez de ' . round($goldDiscount * 100) . '% de reduction.');
    }
}
