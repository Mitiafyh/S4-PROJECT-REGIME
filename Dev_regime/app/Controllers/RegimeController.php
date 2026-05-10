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
  
    public function modifier($id)
    {
        $model = new \App\Models\RegimeModel();
        $regime = $model->find($id);

        if (!$regime) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Régime avec l'ID $id non trouvé");
        }

        $data = [
            'nom' => $this->request->getPost('nom'),
            'pourcentage_viande' => $this->request->getPost('pourcentage_viande'),
            'pourcentage_poisson' => $this->request->getPost('pourcentage_poisson'),
            'pourcentage_volaille' => $this->request->getPost('pourcentage_volaille'),
            'constatation' => $this->request->getPost('constatation'),
            'duree_semaines' => (int) ($this->request->getPost('duree_semaines') ?? 4),
            'prixParSemaine' => $this->request->getPost('prixParSemaine'),
        ];

        if ($this->request->getFile('image')->isValid()) {
            $image = $this->request->getFile('image');
            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/images/regimes', $newName);
            $data['image'] = $newName;
        }

        $model->modifierRegime($id, $data);

        return redirect()->back();
    }
    public function insert()
    {
        $model = new \App\Models\RegimeModel();
        $data = [
            'nom' => $this->request->getPost('nom'),
            'pourcentage_viande' => $this->request->getPost('pourcentage_viande'),
            'pourcentage_poisson' => $this->request->getPost('pourcentage_poisson'),
            'pourcentage_volaille' => $this->request->getPost('pourcentage_volaille'),
            'constatation' => $this->request->getPost('constatation'),
            'duree_semaines' => (int) ($this->request->getPost('duree_semaines') ?? 4),
            'prixParSemaine' => $this->request->getPost('prixParSemaine'),
        ];

        if ($this->request->getFile('image')->isValid()) {
            $image = $this->request->getFile('image');
            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/images/regimes', $newName);
            $data['image'] = $newName;
        }

        $model->ajouterRegime($data);

        return redirect()->back();
    }

    public function supprimer($id)
    {
        $model = new \App\Models\RegimeModel();
        $model->delete($id);
        return redirect()->back();
    }
}
