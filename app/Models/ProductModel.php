<?php 
namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
	protected $table = 'product'; 
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'nama','deskripsi','harga','jumlah','foto','kontak','kategori','domisili','created_at','updated_at'
	];  
}