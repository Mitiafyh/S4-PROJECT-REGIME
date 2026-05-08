<?php

namespace App\Controllers;

use App\Models\CodesModel;
use App\Models\RegimeModel;
use App\Models\SettingsModel;
use App\Models\SportModel;
use App\Models\UserModel;

class AdminController extends BaseController
{
    private function requireAdmin()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/loginAdmin')->with('error', 'Veuillez vous connecter.');
        }

        $userModel = new UserModel();
        $user = $userModel->getUserById($userId);

        if (!$user || ($user['role'] ?? '') !== 'admin') {
            return redirect()->to('/loginAdmin')->with('error', 'Acces reserve aux administrateurs.');
        }

        return $user;
    }

    public function dashboard()
    {
        $adminUser = $this->requireAdmin();
        if ($adminUser instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $adminUser;
        }

        $db = \Config\Database::connect();
        $userCount = $db->table('User')->countAllResults();
        $regimeCount = $db->table('Regime')->countAllResults();
        $activeCodesCount = $db->table('Codes')->where('status', 'active')->countAllResults();

        $revenueRow = $db->table('Regime_Activite_User_Objectif as ruao')
            ->selectSum('r.prixParSemaine', 'total')
            ->join('Regime r', 'r.id = ruao.regime_id', 'left')
            ->get()
            ->getRowArray();
        $totalRevenue = (float) ($revenueRow['total'] ?? 0);

        $recentPurchases = $db->table('Regime_Activite_User_Objectif as ruao')
            ->select('ruao.created_at, r.nom, r.prixParSemaine, u.email')
            ->join('Regime r', 'r.id = ruao.regime_id', 'left')
            ->join('User u', 'u.id = ruao.user_id', 'left')
            ->orderBy('ruao.created_at', 'DESC')
            ->limit(6)
            ->get()
            ->getResultArray();

        $salesRows = $db->table('Regime_Activite_User_Objectif as ruao')
            ->select('DATE(ruao.created_at) as date, SUM(r.prixParSemaine) as total')
            ->join('Regime r', 'r.id = ruao.regime_id', 'left')
            ->where('ruao.created_at >=', date('Y-m-d', strtotime('-6 days')))
            ->groupBy('DATE(ruao.created_at)')
            ->orderBy('DATE(ruao.created_at)', 'ASC')
            ->get()
            ->getResultArray();

        $salesMap = [];
        foreach ($salesRows as $row) {
            $salesMap[$row['date']] = (float) ($row['total'] ?? 0);
        }

        $salesLabels = [];
        $salesData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $salesLabels[] = date('D', strtotime($date));
            $salesData[] = $salesMap[$date] ?? 0;
        }

        return view('Admin/admin_dashboard', [
            'userCount' => $userCount,
            'regimeCount' => $regimeCount,
            'activeCodesCount' => $activeCodesCount,
            'totalRevenue' => $totalRevenue,
            'recentPurchases' => $recentPurchases,
            'salesLabels' => $salesLabels,
            'salesData' => $salesData,
        ]);
    }

    public function regimes()
    {
        $adminUser = $this->requireAdmin();
        if ($adminUser instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $adminUser;
        }

        $regimeModel = new RegimeModel();
        $regimes = $regimeModel->getAll();

        return view('Admin/admin_regimes', [
            'regimes' => $regimes,
        ]);
    }

    public function codes()
    {
        $adminUser = $this->requireAdmin();
        if ($adminUser instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $adminUser;
        }

        $codesModel = new CodesModel();
        $codes = $codesModel->orderBy('id', 'DESC')->findAll();

        return view('Admin/admin_codes', [
            'codes' => $codes,
            'creditAmount' => 50,
        ]);
    }

    public function users()
    {
        $adminUser = $this->requireAdmin();
        if ($adminUser instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $adminUser;
        }

        $userModel = new UserModel();
        $users = $userModel->where('role !=', 'admin')->orderBy('id', 'DESC')->findAll();

        return view('Admin/admin_users', [
            'users' => $users,
        ]);
    }

    public function sports()
    {
        $adminUser = $this->requireAdmin();
        if ($adminUser instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $adminUser;
        }

        $sportModel = new SportModel();
        $sports = $sportModel->getAll();

        return view('Admin/GestionSport', [
            'sports' => $sports,
        ]);
    }

    public function settings()
    {
        $adminUser = $this->requireAdmin();
        if ($adminUser instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $adminUser;
        }

        $settingsModel = new SettingsModel();
        $goldPrice = (float) $settingsModel->getValue('gold_price', 10000);
        $goldDiscountPercent = (float) $settingsModel->getValue('gold_discount_percent', 15);

        return view('Admin/admin_settings', [
            'goldPrice' => $goldPrice,
            'goldDiscountPercent' => $goldDiscountPercent,
        ]);
    }

    public function updateSettings()
    {
        $adminUser = $this->requireAdmin();
        if ($adminUser instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $adminUser;
        }

        $goldPrice = (float) $this->request->getPost('gold_price');
        $goldDiscountPercent = (float) $this->request->getPost('gold_discount_percent');

        if ($goldPrice <= 0) {
            return redirect()->back()->with('error', 'Le prix Gold doit etre superieur a 0.');
        }

        if ($goldDiscountPercent < 0 || $goldDiscountPercent > 100) {
            return redirect()->back()->with('error', 'Le pourcentage Gold doit etre entre 0 et 100.');
        }

        $settingsModel = new SettingsModel();
        $settingsModel->setValue('gold_price', $goldPrice);
        $settingsModel->setValue('gold_discount_percent', $goldDiscountPercent);

        return redirect()->back()->with('success', 'Parametres mis a jour.');
    }

    public function updateUser($id)
    {
        $adminUser = $this->requireAdmin();
        if ($adminUser instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $adminUser;
        }

        $userModel = new UserModel();
        $user = $userModel->getUserById($id);
        if (!$user || ($user['role'] ?? '') === 'admin') {
            return redirect()->back()->with('error', 'Utilisateur invalide.');
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'modeGold' => $this->request->getPost('modeGold') === '1',
            'argent' => (float) $this->request->getPost('argent'),
        ];

        $userModel->update($id, $data);

        return redirect()->back()->with('success', 'Utilisateur mis a jour.');
    }

    public function createCode()
    {
        $adminUser = $this->requireAdmin();
        if ($adminUser instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $adminUser;
        }

        $code = trim((string) $this->request->getPost('code'));
        if ($code === '') {
            return redirect()->back()->with('error', 'Le code est obligatoire.');
        }

        $codesModel = new CodesModel();
        $existing = $codesModel->where('code', $code)->first();
        if ($existing) {
            return redirect()->back()->with('error', 'Ce code existe deja.');
        }

        $valeur = (float) $this->request->getPost('valeur');
        if ($valeur <= 0) {
            $valeur = 50;
        }

        $codesModel->insert([
            'code' => $code,
            'valeur' => $valeur,
            'status' => 'active',
        ]);

        return redirect()->back()->with('success', 'Code promo ajoute.');
    }

    public function deleteCode($id)
    {
        $adminUser = $this->requireAdmin();
        if ($adminUser instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $adminUser;
        }

        $codesModel = new CodesModel();
        $codesModel->delete($id);

        return redirect()->back()->with('success', 'Code promo supprime.');
    }
}
