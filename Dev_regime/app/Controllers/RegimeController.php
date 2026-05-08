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
}
