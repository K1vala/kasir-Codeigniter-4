<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function index()
    {
        return view('admin/user');
    }

    public function getUser()
    {
        $model = new ModelUser();
        $data = $model->findAll();
        echo json_encode($data);
    }

    public function create()
    {
        $model = new ModelUser();
        $password = $this->request->getPost('password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $data = [
            'userID' => $this->request->getPost('userID'),
            'nama_petugas' => $this->request->getPost('nama_petugas'),
            'username' => $this->request->getPost('username'),
            'password' => $hashedPassword,
            'role'=> $this->request->getPost('role'),
        ];
        $model->insert($data);
        echo json_encode(['status' => 'success']);
    }

    public function getUserByID($userID)
    {
        $model = new ModelUser();
        $user = $model->find($userID);

        echo json_encode($user);
    }

    public function update()
    {
        $model = new ModelUser();
        $data = [
            'nama_petugas' => $this->request->getPost('nama_petugas'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'role' => $this->request->getPost('role'),
        ];
        $model->update($this->request->getPost('userID'), $data);
        echo json_encode(['status' => 'success']);
    }

    public function delete()
    {
        $model = new ModelUser();
        $model->delete($this->request->getPost('userID'));
        echo json_encode(['status' => 'success']);
    }
}
