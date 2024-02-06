<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'userID';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['nama_petugas', 'username', 'password', 'role'];

    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}
