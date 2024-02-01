<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelProduk;

class ProdukController extends BaseController
{
    public function index()
    {
        return view('admin/index');
    }

    public function getProduk()
    {
        $model = new ModelProduk();
        $data = $model->findAll();
        echo json_encode($data);
    }

    public function create()
    {
        $model = new ModelProduk();
        $data = [
            'ProdukID' => $this->request->getPost('ProdukID'),
            'NamaProduk' => $this->request->getPost('NamaProduk'),
            'Harga' => $this->request->getPost('Harga'),
            'Stok' => $this->request->getPost('Stok'),
        ];
        $model->insert($data);
        echo json_encode(['status' => 'success']);
    }

    public function getProdukByID($ProdukID)
    {
        $model = new ModelProduk();
        $produk = $model->find($ProdukID);

        echo json_encode($produk);
    }

    public function update()
    {
        $model = new ModelProduk();
        $data = [
            'NamaProduk' => $this->request->getPost('NamaProduk'),
            'Harga' => $this->request->getPost('Harga'),
            'Stok' => $this->request->getPost('Stok'),
        ];
        $model->update($this->request->getPost('ProdukID'), $data);
        echo json_encode(['status' => 'success']);
    }

    public function delete()
    {
        $model = new ModelProduk();
        $model->delete($this->request->getPost('ProdukID'));
        echo json_encode(['status' => 'success']);
    }
}
