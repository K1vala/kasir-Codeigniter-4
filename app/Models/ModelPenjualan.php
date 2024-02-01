<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenjualan extends Model
{
    protected $table            = 'penjualan';
    protected $primaryKey       = 'PenjualanID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['PenjualanID','TanggalPenjualan','TotalHarga','PelangganID'];

}
