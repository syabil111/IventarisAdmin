<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriAset; // Pastikan import ini benar

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data dari database
        $kategoris = KategoriAset::orderBy('created_at', 'desc')->get();

        return view('kategori.index', [
            'title' => 'Manajemen Kategori',
            'kategoris' => $kategoris
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create', [
            'title' => 'Tambah Kategori Baru'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'kode_kategori' => 'required|string|max:10',
            'deskripsi' => 'nullable|string',
            'status' => 'required|boolean'
        ]);

        try {
            // Simpan ke database
            KategoriAset::create([
                'nama_kategori' => $request->nama_kategori,
                'kode_kategori' => $request->kode_kategori,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status
            ]);

            return redirect()->route('kategori.index')
                ->with('success', 'Kategori berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan kategori: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = KategoriAset::findOrFail($id);
        
        return view('kategori.show', [
            'title' => 'Detail Kategori',
            'kategori' => $kategori
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = KategoriAset::findOrFail($id);

        return view('kategori.edit', [
            'title' => 'Edit Kategori',
            'kategori' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, $id)
    {
        // Validasi yang benar
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'status' => 'required|boolean',
            'deskripsi' => 'nullable|string'
        ]);

        // Cari kategori
        $kategori = KategoriAset::find($id);

        if (!$kategori) {
            return back()->with('error', 'Kategori tidak ditemukan');
        }

        // Update data
        $kategori->update($validated);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $kategori = KategoriAset::findOrFail($id);
            $kategori->delete();

            return redirect()->route('kategori.index')
                ->with('success', 'Kategori berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }
}