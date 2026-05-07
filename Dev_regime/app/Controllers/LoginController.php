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

  

    public function login(): string
    {
        return view('login');
    }

  

    public function form(): string
    {
        return view('LoginForm');
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
}