<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDetailPenjualan extends Model
{
    protected $table            = 'detailpenjualan';
    protected $primaryKey       = 'DEtailID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['DetailID','PenjualanID','ProdukID','JumlahProduk','Subtotal'];

}
