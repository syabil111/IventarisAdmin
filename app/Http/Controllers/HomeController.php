<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemeliharaanAset;

class HomeController extends Controller
{
    public function index()
    {
        // Data statistik sementara (tanpa model)
        $data = [
            'totalKategori' => 0, // Default value
            'totalAset' => 0,     // Default value
            'totalPemeliharaan' => 0, // Default value
        ];

        // Coba ambil data jika model ada
        try {
            if (class_exists('App\Models\KategoriAset')) {
                $data['totalKategori'] = \App\Models\KategoriAset::count();
            }


        } catch (\Exception $e) {
            // Tetap lanjut dengan nilai default
        }

        return view('pages.home', $data);
    }
}
