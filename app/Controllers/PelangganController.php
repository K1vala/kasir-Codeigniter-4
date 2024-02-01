<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPelanggan;
use CodeIgniter\HTTP\ResponseInterface;

class PelangganController extends BaseController
{
    public function index()
    {
        return view('admin/pelanggan');
    }

    public function getPelanggan()
    {
        $model = new ModelPelanggan();
        $data = $model->findAll();
        echo json_encode($data);
    }

    public function create()
    {
        $model = new ModelPelanggan();
        $data = [
            'PelangganID' => $this->request->getPost('PelangganID'),
            'NamaPelanggan' => $this->request->getPost('NamaPelanggan'),
            'Alamat' => $this->request->getPost('Alamat'),
            'NomorTelepon' => $this->request->getPost('NomorTelepon'),
        ];
        $model->insert($data);
        echo json_encode(['status' => 'success']);
    }

    public function getPelangganByID($PelangganID)
    {
        $model = new ModelPelanggan();
        $pelanggan = $model->find($PelangganID);

        echo json_encode($pelanggan);
    }

    public function update()
    {
        $model = new ModelPelanggan();
        $data = [
            'NamaPelanggan' => $this->request->getPost('NamaPelanggan'),
            'Alamat' => $this->request->getPost('Alamat'),
            'NomorTelepon' => $this->request->getPost('NomorTelepon'),
        ];
        $model->update($this->request->getPost('PelangganID'), $data);
        echo json_encode(['status' => 'success']);
    }

    public function delete()
    {
        $model = new ModelPelanggan();
        $model->delete($this->request->getPost('PelangganID'));
        echo json_encode(['status' => 'success']);
    }
}
