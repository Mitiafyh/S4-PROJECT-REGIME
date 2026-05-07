<?php

namespace App\Controllers;

class UserController extends BaseController
{
    public function infoSante()
    {
        return view('users/info_sante');
    }
    public function validateInfoSante()
    {
        $poids = $this->request->getPost('poids');
        $taille = $this->request->getPost('taille');
        $genre = $this->request->getPost('genre');

        $errors = [];
        if (!is_numeric($poids) || $poids < 20 || $poids > 500) {
            $errors[] = 'Poids invalide.';
        }
        if (!is_numeric($taille) || $taille < 0.5 || $taille > 3) {
            $errors[] = 'Taille invalide.';
        }
        if (empty($genre)) {
            $errors[] = 'Genre non sélectionné.';
        }

        if (!empty($errors)) {
            return redirect()->back()->with('errors', implode(' ', $errors));
        }
        $session = session();
        $session->set('poids', $poids);
        $session->set('taille', $taille);
        $session->set('genre', $genre);

        $imc = round($poids / ($taille * $taille), 1);

        return redirect()->to('/users/choix_objectif')->with('imc', $imc);
    }
    public function choix_objectif()
    {
        $model = new \App\Models\ObjectifModel();
        $objectifs = $model->getAll();
        $imc = session()->getFlashdata('imc');

        return view('users/choix_objectif', [
            'objectifs' => $objectifs,
            'imc' => $imc,
        ]);
    }
    public function validateChoixObjectif()
    {
        $objectifId = $this->request->getPost('objectif');
        if (empty($objectifId)) {
            return redirect()->back()->with('error', 'Veuillez sélectionner un objectif.');
        }
            $session = session();
            $session->set('objectif_id', $objectifId);

        return view('users/LoginForm');
    }
}