<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Aset;
use App\Models\Kategori;

class AsetSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan ada kategori terlebih dahulu
        if (Kategori::count() == 0) {
            $this->call([KategoriSeeder::class]);
        }

        $kategoris = Kategori::all();

        $asets = [
            [
                'kode_aset' => 'ASET-001',
                'nama_aset' => 'Laptop Dell XPS 13',
                'tgl_perolehan' => '2024-01-15',
                'nilai_perolehan' => 15000000,
                'kondisi' => 'Baik',
                'kategori_id' => $kategoris->where('nama_kategori', 'Elektronik')->first()->kategori_id ?? $kategoris->first()->kategori_id
            ],
            [
                'kode_aset' => 'ASET-002',
                'nama_aset' => 'Meja Kantor Executive',
                'tgl_perolehan' => '2024-02-20',
                'nilai_perolehan' => 2500000,
                'kondisi' => 'Baik',
                'kategori_id' => $kategoris->where('nama_kategori', 'Furnitur')->first()->kategori_id ?? $kategoris->first()->kategori_id
            ],
            [
                'kode_aset' => 'ASET-003',
                'nama_aset' => 'Printer Canon PIXMA',
                'tgl_perolehan' => '2023-12-10',
                'nilai_perolehan' => 1800000,
                'kondisi' => 'Rusak Ringan',
                'kategori_id' => $kategoris->where('nama_kategori', 'Elektronik')->first()->kategori_id ?? $kategoris->first()->kategori_id
            ],
            [
                'kode_aset' => 'ASET-004',
                'nama_aset' => 'Mobil Toyota Avanza',
                'tgl_perolehan' => '2023-11-05',
                'nilai_perolehan' => 185000000,
                'kondisi' => 'Baik',
                'kategori_id' => $kategoris->where('nama_kategori', 'Kendaraan')->first()->kategori_id ?? $kategoris->first()->kategori_id
            ],
            [
                'kode_aset' => 'ASET-005',
                'nama_aset' => 'AC Split Panasonic',
                'tgl_perolehan' => '2024-03-10',
                'nilai_perolehan' => 4200000,
                'kondisi' => 'Baik',
                'kategori_id' => $kategoris->where('nama_kategori', 'Elektronik')->first()->kategori_id ?? $kategoris->first()->kategori_id
            ],
        ];

        foreach ($asets as $aset) {
            Aset::create($aset);
        }
    }
}