<?php

namespace App\Controllers;

class SportController extends BaseController
{
    public function index()
    {
        $model = new \App\Models\SportModel();
        $sports = $model->getAll();

        return view('Admin/GestionSport', [
            'sports' => $sports
        ]);
    }
  
    public function modifier($id)
    {
        $model = new \App\Models\SportModel();
        $sport = $model->find($id);

        if (!$sport) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Sport avec l'ID $id non trouvé");
        }

        $data = [
            'type' => $this->request->getPost('type'),
            'duree' => $this->request->getPost('duree'),
            'repetition' => $this->request->getPost('repetition'),
            'depense_calorique' => $this->request->getPost('depense_calorique'),
        ];
        $model->update($id, $data);
        return redirect()->to('/gestionSport');
    }
    public function insert()
    {
        $model = new \App\Models\SportModel();
        $data = [
            'type' => $this->request->getPost('type'),
            'duree' => $this->request->getPost('duree'),
            'repetition' => $this->request->getPost('repetition'),
            'depense_calorique' => $this->request->getPost('depense_calorique'),
            'image' => $this->request->getPost('image'),
        ];

        if ($this->request->getFile('image')->isValid()) {
            $image = $this->request->getFile('image');
            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/images/regimes', $newName);
            $data['image'] = $newName;
        }

        $model->insert($data);

        return redirect()->to('/gestionSport');
    }

    public function supprimer($id)
    {
        $model = new \App\Models\SportModel();
        $model->delete($id);
        return redirect()->to('/gestionSport');
    }
}
