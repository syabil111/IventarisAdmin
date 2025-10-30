<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $kategoris = [
            [
                'nama_kategori' => 'Elektronik',
                'kode_kategori' => 'KAT-' . strtoupper(Str::random(6)),
                'deskripsi' => 'Kategori untuk peralatan elektronik dan gadget',
                'status' => true
            ],
            [
                'nama_kategori' => 'Furniture',
                'kode_kategori' => 'KAT-' . strtoupper(Str::random(6)),
                'deskripsi' => 'Kategori untuk perabotan dan furniture kantor',
                'status' => true
            ],
            [
                'nama_kategori' => 'Kendaraan',
                'kode_kategori' => 'KAT-' . strtoupper(Str::random(6)),
                'deskripsi' => 'Kategori untuk kendaraan operasional perusahaan',
                'status' => true
            ],
            [
                'nama_kategori' => 'Peralatan Kantor',
                'kode_kategori' => 'KAT-' . strtoupper(Str::random(6)),
                'deskripsi' => 'Kategori untuk alat tulis dan perlengkapan kantor',
                'status' => true
            ]
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}