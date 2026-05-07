<?php

namespace App\Controllers;

use App\Models\LoginModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Validation\RegisterValidation;

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
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->loginModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Email ou mot de passe incorrect');
        }
        return view('accueil');
    }

    public function formAdmin(): string
    {
        return view('Admin/LoginAdminForm');
    }

    public function authAdmin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->loginModel->where('email', $email)->first();

        if (!$user || $password !== $user['password'] || $user['role'] !== 'admin') {
            return redirect()->back()->with('error', 'Email ou mot de passe incorrect ou vous n\'êtes pas un administrateur');
        }
        return view('Admin/dashboard');
    }
    public function inscriptionForm(): string
    {
        return view('users/InscriptionForm');
    }


    public function register()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password')
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
        return view('accueil');
    }
}
