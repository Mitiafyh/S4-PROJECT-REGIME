<?php

namespace App\Controllers;

class RegimeController extends BaseController
{
    public function index()
    {
        $model = new \App\Models\RegimeModel();
        $regimes = $model->getAll();

        return view('regimes/listeRegime', [
            'regimes' => $regimes
        ]);
    }
    public function ajoutForm()
    {
        return view('regimes/ajoutRegime');
    }
    public function modifier($id)
    {
        $model = new \App\Models\RegimeModel();
        $regime = $model->find($id);

        if (!$regime) {
            return redirect()->to('/Regime')->with('error', 'Régime non trouvé.');
        }

        return view('regimes/modifierRegime', [
            'regime' => $regime
        ]);
    }

    public function supprimer($id)
    {
        $model = new \App\Models\RegimeModel();
        $model->delete($id);
        return redirect()->to('/Regime');
    }
}
