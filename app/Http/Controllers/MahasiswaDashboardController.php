<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaDashboardController extends Controller
{
    public function index()
    {
        return view('mahasiswa.dashboard'); // sesuaikan dengan view yang kamu buat
    }
}
