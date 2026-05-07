<?php

namespace App\Controllers;

use App\Models\LoginModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Exceptions\PageNotFoundException;

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

        if (!$user || $password !== $user['password']) {
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
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if ($this->loginModel->where('email', $email)->first()) {
            return redirect()->back()->with('error', 'Cet email est déjà utilisé');
        }

        $this->loginModel->save([
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ]);

        return view('accueil');
    }
}
