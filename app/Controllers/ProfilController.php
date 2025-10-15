<?php

namespace App\Controllers;

use App\Controllers\BaseController;

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
        $produkModel = new ProductModel();

        // Ambil user_id dari session
        $userId = session()->get('user_id');

        // Ambil hanya produk milik user yang sedang login
        $produk = $produkModel->where('user_id', $userId)->findAll();

        $data = [
            'product' => $produk
        ];

        return view('v_profil', $data);
    }
}