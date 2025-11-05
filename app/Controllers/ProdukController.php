<?php

namespace App\Controllers;

use App\Models\ProductModel;
use Dompdf\Dompdf;

class ProdukController extends BaseController
{
    protected $product; 

    function __construct()
    {
        $this->product = new ProductModel();
        helper('session');
    }

    /*public function index()
    {
        $product = $this->product->findAll();
        $data['product'] = $product;

        return view('v_produk', $data);
    }*/

    public function index()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('product');
        $builder->select('product.*, user.username, user.wa, user.fb, user.ig');
        $builder->join('user', 'user.id = product.user_id', 'left');
        $query = $builder->get();
        $produk = $query->getResultArray();
        

        $data['produk'] = $produk;

        return view('v_home', $data);
    }

    public function create()
    {
        $session = session();
        $dataFoto = $this->request->getFile('foto');

        $dataForm = [
            'user_id' => $session->get('user_id'),
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga' => $this->request->getPost('harga'),
            'kontak' => $this->request->getPost('kontak'),
            'domisili' => $this->request->getPost('domisili'),
            'domisili_nama' => $this->request->getPost('domisili_nama'),
            'created_at' => date("Y-m-d H:i:s")
        ];

        if ($dataFoto->isValid()) {
            $fileName = $dataFoto->getRandomName();
            $dataForm['foto'] = $fileName;
            $dataFoto->move('img/', $fileName);
        }

        $this->product->insert($dataForm);

        return redirect('profil')->with('success', 'Data Berhasil Ditambah');
    } 

    public function edit($id)
    {
        $session = session();
        $dataProduk = $this->product->find($id);

        $dataForm = [
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga' => $this->request->getPost('harga'),
            'kontak' => $this->request->getPost('kontak'),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        if (!$dataProduk || $dataProduk['user_id'] != $session->get('user_id')) {
            return redirect()->back()->with('error','Tidak diizinkan.');
        }

        if ($this->request->getPost('check') == 1) {
            if ($dataProduk['foto'] != '' and file_exists("img/" . $dataProduk['foto'] . "")) {
                unlink("img/" . $dataProduk['foto']);
            }

            $dataFoto = $this->request->getFile('foto');

            if ($dataFoto->isValid()) {
                $fileName = $dataFoto->getRandomName();
                $dataFoto->move('img/', $fileName);
                $dataForm['foto'] = $fileName;
            }
        }

        $this->product->update($id, $dataForm);

        return redirect('profil')->with('success', 'Data Berhasil Diubah');
    }

    public function delete($id)
    {
        $session = session();
        $dataProduk = $this->product->find($id);

        if ($dataProduk['foto'] != '' and file_exists("img/" . $dataProduk['foto'] . "")) {
            unlink("img/" . $dataProduk['foto']);
        }

        if ($dataProduk && $dataProduk['user_id'] == $session->get('user_id')) {
        $this->product->delete($id);
        }

        return redirect('profil')->with('success', 'Data Berhasil Dihapus');
    }

    /*public function download()
    {
		//get data from database
        $product = $this->product->findAll();

		//pass data to file view
        $html = view('v_produkPDF', ['product' => $product]);

		//set the pdf filename
        $filename = date('y-m-d-H-i-s') . '-produk';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content (file view)
        $dompdf->loadHtml($html);

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }*/
}