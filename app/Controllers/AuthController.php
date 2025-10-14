<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;
class AuthController extends BaseController
{
    protected $user;
    function __construct()
    {
        helper('form');
        $this->user = new UserModel();
    }

    public function register()
    {
    if ($post = $this->request->getPost()) {
        $data = [
            'nama_lengkap' => $post['nama_lengkap'],
            'username' => $post['username'],
            'email' => $post['email'],
            'password' => $post['password'],
            'created_at' => date("Y-m-d H:i:s")
        ];

        if (!$this->validate([
            'nama_lengkap' => 'required',
            'username' => 'required|is_unique[user.username]',
            'email' => 'required|valid_email|is_unique[user.email]',
            'password' => 'required|min_length[7]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->user->insert($data);
        session()->setFlashdata('success','Akun berhasil dibuat. Silakan login.');
        return redirect()->to('/login'); // login route harus ada
    }

    return view('v_register'); 
    }

    public function login()
    {
    if ($this->request->getPost()) {
        $rules = [
            'username' => 'required|min_length[6]',
            'password' => 'required|min_length[7]',
        ];

        if ($this->validate($rules)) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $dataUser = $this->user->where(['username' => $username])->first(); //pasw 1234567

            if ($dataUser) {
                if (password_verify($password, $dataUser['password'])) {
                    session()->set([
                        'user_id' => $dataUser['id'],
                        'username' => $dataUser['username'],
                        'email' => $dataUser['email'],
                        'nama_lengkap' => $dataUser['nama_lengkap'],
                        'role' => $dataUser['role'],
                        'isLoggedIn' => TRUE
                    ]);

                    return redirect()->to(base_url('/'));
                } else {
                    session()->setFlashdata('failed', 'Kombinasi Username & Password Salah');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('failed', 'Username Tidak Ditemukan');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('failed', $this->validator->listErrors());
            return redirect()->back();
        }
    }

    return view('v_login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
