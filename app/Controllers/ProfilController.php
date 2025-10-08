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
        $product = $this->product->findAll();
        $data['product'] = $product;

        return view('v_profil', $data);
    }
}