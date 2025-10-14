<?php

namespace App\Controllers;

use App\Models\ProductModel;
class Home extends BaseController
{
    protected $product;

    function __construct()
    {
        $this->product = new ProductModel();
    }
    public function index()
    {
        $produkModel = new ProductModel();

        // Ambil parameter GET
        $nama = $this->request->getGet('nama');
        $domisili = $this->request->getGet('domisili');

        // Jika ada pencarian, pakai filter
        if (!empty($nama) || !empty($domisili)) {
        $produk = $produkModel->searchProducts($nama, $domisili);
        } else {
        // Kalau tidak ada pencarian, tampilkan semua produk
        $produk = $produkModel->findAll();
        }

        // Kirim data ke view
        return view('v_home', [
        'produk' => $produk,
        'nama' => $nama,
        'domisili_nama' => $domisili
        ]);
    }
}
