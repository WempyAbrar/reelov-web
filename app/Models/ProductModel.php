<?php 
namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
	protected $table = 'product'; 
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'user_id','nama','deskripsi','harga','jumlah','foto','kontak','kategori','domisili','domisili_nama','created_at','updated_at'
	];  

	public function searchProducts($nama = null, $domisili = null)
	{
    $builder = $this->db->table('product');

    if (!empty($nama)) {
        $builder->like('nama', $nama);
    }

    if (!empty($domisili)) {
        // Kolom 'domisili_nama' berisi teks seperti "SEMARANG TENGAH, SEMARANG, JAWA TENGAH"
        $builder->like('domisili_nama', $domisili);
    }

    return $builder->get()->getResultArray();
	}
}