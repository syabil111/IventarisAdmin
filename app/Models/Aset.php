<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;

    protected $table = 'asets';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nama_aset',
        'kode_aset',
        'kategori_id',
        'lokasi_id',
        'deskripsi',
        'status'
    ];

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}