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
    $db = \Config\Database::connect();
    $builder = $db->table('product');
    $builder->select('product.*, user.username, user.wa, user.fb, user.ig');
    $builder->join('user', 'user.id = product.user_id', 'left');

    // Ambil parameter GET dari search bar dan sidebar
    $nama = $this->request->getGet('nama');
    $domisili = $this->request->getGet('domisili');
    $kategori = $this->request->getGet('kategori');

    // Filter berdasarkan kategori (kalau ada)
    if (!empty($kategori)) {
        $builder->where('product.kategori', $kategori);
    }

    // Filter berdasarkan nama barang (kalau ada)
    if (!empty($nama)) {
        $builder->like('product.nama', $nama);
    }

    // Filter berdasarkan domisili (kalau ada)
    if (!empty($domisili)) {
        $builder->like('product.domisili_nama', $domisili);
    }

    // Jalankan query
    $query = $builder->get();
    $produk = $query->getResultArray();

    // Kirim data ke view
    return view('v_home', [
        'produk' => $produk,
        'nama' => $nama,
        'domisili_nama' => $domisili,
        'kategori_aktif' => $kategori
    ]);
    }
}
