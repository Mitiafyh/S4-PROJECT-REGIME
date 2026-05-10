<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Models\Info_SanteModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Validation\RegisterValidation;
use App\Validation\LoginValidation;

class LoginController extends BaseController
{
    private LoginModel $loginModel;

    public function __construct()
    {
        $this->loginModel = new LoginModel();
    }


    public function form(): string
    {
        return view('users/LoginForm');
    }

    public function auth()
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];

        $errors = LoginValidation::validate($data);

        if (!empty($errors)) {
            return redirect()->back()->with('errors', $errors)->withInput();
        }

        $email = $data['email'];
        $password = $data['password'];

        $user = $this->loginModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Email ou mot de passe incorrect');
        }
        session()->set('user_id', $user['id']);
        return redirect()->to('/users/dashboard');
    }

    public function formAdmin(): string
    {
        return view('Admin/LoginAdminForm');
    }

    public function authAdmin()
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];

        $errors = LoginValidation::validate($data);

        if (!empty($errors)) {
            return redirect()->back()->with('errors', $errors)->withInput();
        }

        $email = $data['email'];
        $password = $data['password'];

        $user = $this->loginModel->where('email', $email)->first();
        if (!$user || $password !== $user['password'] || $user['role'] !== 'admin') {
            return redirect()->back()->with('error', 'Email ou mot de passe incorrect ou vous n\'êtes pas un administrateur');
        }
        session()->set('user_id', $user['id']);
        return redirect()->to('/admin/dashboard');
    }

    public function logout(): RedirectResponse
    {
        $session = session();
        $session->remove('user_id');
        $session->setFlashdata('success', 'Vous êtes déconnecté.');

        return redirect()->to('/');
    }

    public function inscriptionForm(): RedirectResponse
    {
        return redirect()->to('/users/infoSante');
    }


    public function register()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];

        $errors = RegisterValidation::validate($data);

        if (!empty($errors)) {
            return redirect()->back()->with('error', 'Validation incorrecte');
        }

        $passwordHash =
            password_hash($data['password'], PASSWORD_DEFAULT);
        $this->loginModel->insert([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $passwordHash
        ]);
        $model = new Info_SanteModel();
        $session = session();
        $session->set('user_id', $this->loginModel->getInsertID());

        $model->saveInfoSante([
        'user_id' => $this->loginModel->getInsertID(),
        'poids' => $session->get('poids'),
        'taille' => $session->get('taille'),
        'genre' => $session->get('genre')
        ]);
        return redirect()->to('/users/dashboard')->with('success', 'Inscription réussie');
    }
}
