<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelUser;

class AuthController extends BaseController
{
    public function index()
    {
        return view('auth/login.php');
    }
    public function login()
    {
        // Validasi login
        // (Periksa apakah username dan password sesuai dengan yang ada di database)
        $session = session();
        $modelUser = new ModelUser();

        // Ambil data username dan password dari form login
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cek apakah username ada dalam database
        $data = $modelUser->getUserByUsername($username);

        
            // Jika username ditemukan, periksa apakah password cocok
            if ($data && password_verify($password, $data->password)) {
                // Password cocok, buat sesi login
                $ses_data = [
                    'userID'=> $data->userID,
                    'username'=> $data->username,
                    'nama_petugas'=> $data->nama_petugas,
                ];
                $session->set($ses_data);

                return redirect()->to(base_url())->with('error', 'Username atau password salah.');
                // Redirect ke halaman dashboard atau halaman yang diinginkan
            } else {
                return redirect()->to('/dashboard');
            }
        

        // Jika username atau password salah, tampilkan pesan error atau redirect ke halaman login dengan pesan error
    }

    public function logout()
    {
        // Hapus semua data sesi
        $session = session();
        $session->destroy();

        // Redirect ke halaman login
        return redirect()->to('/login');
    }
}
