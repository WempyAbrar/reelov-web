<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\UserModel;
use App\Models\ProductModel;

class ProfilController extends BaseController 
{
    protected $product;

    function __construct()
    {
        $this->product = new ProductModel();
    }

    public function index()
    {
        $userModel = new UserModel();
        $produkModel = new ProductModel();

        // Ambil user_id dari session
        $userId = session()->get('user_id');

        // Ambil data user berdasarkan ID
        $user = $userModel->find($userId);

        // Ambil hanya produk milik user yang sedang login
        $produk = $produkModel->where('user_id', $userId)->findAll();

        $data = [
            'user' => $user,
            'product' => $produk
        ];

        return view('v_profil', $data);
    }

    public function update()
    {
        $id = session()->get('user_id'); // pastikan user ID tersimpan di session

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email' => $this->request->getPost('email'),
            'wa' => $this->request->getPost('wa'),
            'fb' => $this->request->getPost('fb'),
            'ig' => $this->request->getPost('ig'),
        ];

        // Debug sementara: cek apakah data dan id sudah terbaca
        // dd($id, $data);

        $userModel = new UserModel();
        $update = $userModel->where('id', $id)->set($data)->update();

        if ($update) {
            session()->setFlashdata('success', 'Profil berhasil diupdate');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui profil');
        }

        return redirect()->to(base_url('profil'));
    }
}