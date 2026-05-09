<?php

namespace App\Controllers;

use App\Models\ObjectifModel;
use App\Models\RegimeModel;
use App\Models\UserModel;

class DashboardController extends BaseController
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

        $settings = $this->getSettingsData();

        return view('users/dashboard', [
            'user' => $user,
            'objectif' => $objectif,
            'infoSante' => $infoSante,
            'regimes' => array_slice($regimes, 0, 3),
            'imc' => $imc,
            'imcBarPercent' => $imcBarPercent,
            'goldSettings' => $settings,
        ]);
    }

    public function exportRegimesPdf()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter.');
        }

        $fpdfPath = FCPATH . 'fpdf186/fpdf.php';
        if (!is_file($fpdfPath)) {
            return redirect()->back()->with('error', 'FPDF introuvable dans le dossier public/fpdf186.');
        }

        require_once $fpdfPath;

        $userModel = new UserModel();
        $objectifModel = new ObjectifModel();
        $regimeModel = new RegimeModel();
        $db = \Config\Database::connect();

        $user = $userModel->getUserById($userId);
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
        $objectifDescription = is_array($objectif ?? null)
            ? (string) ($objectif['description'] ?? 'Non defini')
            : 'Non defini';

        $regimes = $objectifId
            ? array_slice($regimeModel->getRegimesByObjectifId((int) $objectifId, (int) $userId), 0, 10)
            : [];

        $settings = $this->getSettingsData();
        $generalCurrency = (string) ($settings['general_currency'] ?? 'Ar');
        $username = is_array($user ?? null) ? (string) ($user['username'] ?? 'Utilisateur') : 'Utilisateur';

        $toPdfText = static function (string $text): string {
            return utf8_decode($text);
        };

        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->SetTitle($toPdfText('Regimes suggeres - NutriFlow'));
        $pdf->SetAuthor('NutriFlow');
        $pdf->SetMargins(12, 12, 12);
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, $toPdfText('NutriFlow - Regimes suggeres'), 0, 1, 'L');

        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 8, $toPdfText('Utilisateur: ' . $username), 0, 1, 'L');
        $pdf->Cell(0, 8, $toPdfText('Objectif: ' . $objectifDescription), 0, 1, 'L');
        $pdf->Cell(0, 8, $toPdfText('Date: ' . date('d/m/Y H:i')), 0, 1, 'L');
        $pdf->Ln(2);

        if (empty($regimes)) {
            $pdf->SetFont('Arial', '', 11);
            $pdf->MultiCell(0, 8, $toPdfText('Aucun regime disponible pour votre objectif actuel.'), 0, 'L');
        } else {
            foreach ($regimes as $index => $regime) {
                $name = (string) ($regime['nom'] ?? ('Regime #' . ($regime['id'] ?? $index + 1)));
                $constatation = (float) ($regime['constatation'] ?? 0);
                $price = (float) ($regime['prixParSemaine'] ?? 0);
                $viande = (int) ($regime['pourcentage_viande'] ?? 0);
                $poisson = (int) ($regime['pourcentage_poisson'] ?? 0);
                $volaille = (int) ($regime['pourcentage_volaille'] ?? 0);

                $pdf->SetFillColor(245, 245, 244);
                $pdf->SetDrawColor(231, 229, 228);
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(0, 9, $toPdfText(($index + 1) . '. ' . $name), 1, 1, 'L', true);

                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(0, 7, $toPdfText('Constatation: ' . number_format($constatation, 2, '.', '') . ' kg/semaine'), 1, 1, 'L');
                $pdf->Cell(0, 7, $toPdfText('Prix: ' . number_format($price, 2, '.', '') . ' ' . $generalCurrency), 1, 1, 'L');
                $pdf->Cell(0, 7, $toPdfText('Composition - Viande: ' . $viande . '% | Poisson: ' . $poisson . '% | Volaille: ' . $volaille . '%'), 1, 1, 'L');
                $pdf->Ln(3);
            }
        }

        $content = $pdf->Output('S');
        $filename = 'regimes-suggeres-' . date('Ymd-His') . '.pdf';

        return $this->response
            ->setStatusCode(200)
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"')
            ->setBody($content);
    }
    
}
