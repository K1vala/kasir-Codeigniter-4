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

        // Ambil data username dan password dari form login
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cek apakah username ada dalam database
        $modelUser = new ModelUser();
        $user = $modelUser->where('username', $username)->first();

        if ($user) {
            // Jika username ditemukan, periksa apakah password cocok
            if (password_verify($password, $user->password)) {
                // Password cocok, buat sesi login
                $session = session();
                $session->set('userID', $user->userID);
                $session->set('username', $user->username);
                //$session->set('role', $user['role']);

                // Redirect ke halaman dashboard atau halaman yang diinginkan
                return redirect()->to('/login')->with('error', 'Username atau password salah.');
            } else {
                return redirect()->to('/dashboard');
            }
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
