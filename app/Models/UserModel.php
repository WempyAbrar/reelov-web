<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username', 'email', 'nama_lengkap', 'password', 'role', 'created_at', 'updated_at'
    ];

    protected $beforeInsert = ['hashPassword'];
    protected function hashPassword(array $data)
    {
    if (isset($data['data']['password'])) {
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
    }
    return $data;
    }

}