<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function template()
    {
        return view('template/index.php');
    }

    public function adminPanel()
    {
        return view('admin/index.php');
    }
}
