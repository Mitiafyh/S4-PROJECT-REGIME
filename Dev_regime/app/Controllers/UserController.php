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

        // Validation simple côté serveur
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

        // Calcul de l'IMC
        $imc = round($poids / ($taille * $taille), 1);

        return redirect()->to('/users/choix_objectif')->with('imc', $imc);
    }
    public function choix_objectif()
    {
        $model = new \App\Models\ObjectifModel();
        $objectifs = $model->getAll();

        return view('users/choix_objectif', ['objectifs' => $objectifs]);
    }
    public function choice()
    {
        return view('users/register');
    }
}