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

    // Ambil parameter GET dari search bar dan sidebar
    $nama = $this->request->getGet('nama');
    $domisili = $this->request->getGet('domisili');
    $kategori = $this->request->getGet('kategori');

    // Mulai query builder
    $query = $produkModel;

    // Filter berdasarkan kategori (kalau ada)
    if (!empty($kategori)) {
        $query = $query->where('kategori', $kategori);
    }

    // Filter berdasarkan nama barang (kalau ada)
    if (!empty($nama)) {
        $query = $query->like('nama', $nama);
    }

    // Filter berdasarkan domisili (kalau ada)
    if (!empty($domisili)) {
        $query = $query->like('domisili_nama', $domisili);
    }

    // Jalankan query
    $produk = $query->findAll();

    // Kirim data ke view
    return view('v_home', [
        'produk' => $produk,
        'nama' => $nama,
        'domisili_nama' => $domisili,
        'kategori_aktif' => $kategori
    ]);
    }
}
