<?php

namespace App\Controllers;

use App\Models\BBModel;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    protected $bbModel;

    public function __construct()
    {
        $this->bbModel = new BBModel();
    }

    public function index()
    {
        // Jika sudah login, redirect ke halaman admin
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('admin'));
        }
        return view('auth/login');
    }

    public function processLogin()
    {
        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validasi form
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            $session->setFlashdata('error', 'Username dan password harus diisi.');
            return redirect()->to(base_url('auth'));
        }

        $admin = $this->bbModel->getAdminByUsername($username);

        if ($admin) {
            if (password_verify($password, $admin['password'])) {
                $ses_data = [
                    'id_admin'  => $admin['id_admin'],
                    'username'  => $admin['username'],
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);
                $session->setFlashdata('success', 'Login berhasil!');
                return redirect()->to(base_url('admin'));
            } else {
                $session->setFlashdata('error', 'Password salah.');
                return redirect()->to(base_url('auth'));
            }
        } else {
            $session->setFlashdata('error', 'Username tidak ditemukan.');
            return redirect()->to(base_url('auth'));
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('auth'));
    }
}