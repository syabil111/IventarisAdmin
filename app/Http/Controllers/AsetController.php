<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aset = Aset::with('kategori')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
        
        return view('pages.aset.index', compact('aset'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('pages.aset.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'kode_aset' => 'required|unique:aset,kode_aset|max:50',
            'nama_aset' => 'required|max:255',
            'tgl_perolehan' => 'required|date',
            'nilai_perolehan' => 'required|numeric|min:0',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'foto_aset' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'kategori_id.required' => 'Kategori aset harus dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
            'kode_aset.required' => 'Kode aset harus diisi.',
            'kode_aset.unique' => 'Kode aset sudah digunakan.',
            'kode_aset.max' => 'Kode aset maksimal 50 karakter.',
            'nama_aset.required' => 'Nama aset harus diisi.',
            'nama_aset.max' => 'Nama aset maksimal 255 karakter.',
            'tgl_perolehan.required' => 'Tanggal perolehan harus diisi.',
            'tgl_perolehan.date' => 'Format tanggal perolehan tidak valid.',
            'nilai_perolehan.required' => 'Nilai perolehan harus diisi.',
            'nilai_perolehan.numeric' => 'Nilai perolehan harus berupa angka.',
            'nilai_perolehan.min' => 'Nilai perolehan tidak boleh negatif.',
            'kondisi.required' => 'Kondisi aset harus dipilih.',
            'kondisi.in' => 'Kondisi aset tidak valid.',
            'foto_aset.image' => 'File harus berupa gambar.',
            'foto_aset.mimes' => 'Gambar harus berformat: jpeg, png, jpg, gif.',
            'foto_aset.max' => 'Ukuran gambar maksimal 2MB.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('foto_aset')) {
            $file = $request->file('foto_aset');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/aset', $filename);
            $data['foto_aset'] = $filename;
        }

        Aset::create($data);

        return redirect()->route('aset.index')
            ->with('success', 'Data aset berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $aset = Aset::with('kategori')->findOrFail($id);
        return view('pages.aset.show', compact('aset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $aset = Aset::findOrFail($id);
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('pages.aset.edit', compact('aset', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $aset = Aset::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'kode_aset' => 'required|max:50|unique:aset,kode_aset,' . $aset->aset_id . ',aset_id',
            'nama_aset' => 'required|max:255',
            'tgl_perolehan' => 'required|date',
            'nilai_perolehan' => 'required|numeric|min:0',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'foto_aset' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'kategori_id.required' => 'Kategori aset harus dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
            'kode_aset.required' => 'Kode aset harus diisi.',
            'kode_aset.unique' => 'Kode aset sudah digunakan.',
            'kode_aset.max' => 'Kode aset maksimal 50 karakter.',
            'nama_aset.required' => 'Nama aset harus diisi.',
            'nama_aset.max' => 'Nama aset maksimal 255 karakter.',
            'tgl_perolehan.required' => 'Tanggal perolehan harus diisi.',
            'tgl_perolehan.date' => 'Format tanggal perolehan tidak valid.',
            'nilai_perolehan.required' => 'Nilai perolehan harus diisi.',
            'nilai_perolehan.numeric' => 'Nilai perolehan harus berupa angka.',
            'nilai_perolehan.min' => 'Nilai perolehan tidak boleh negatif.',
            'kondisi.required' => 'Kondisi aset harus dipilih.',
            'kondisi.in' => 'Kondisi aset tidak valid.',
            'foto_aset.image' => 'File harus berupa gambar.',
            'foto_aset.mimes' => 'Gambar harus berformat: jpeg, png, jpg, gif.',
            'foto_aset.max' => 'Ukuran gambar maksimal 2MB.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('foto_aset')) {
            // Delete old file
            if ($aset->foto_aset) {
                Storage::delete('public/aset/' . $aset->foto_aset);
            }

            $file = $request->file('foto_aset');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/aset', $filename);
            $data['foto_aset'] = $filename;
        }

        // Handle delete photo checkbox
        if ($request->has('hapus_foto') && $request->hapus_foto == '1') {
            if ($aset->foto_aset) {
                Storage::delete('public/aset/' . $aset->foto_aset);
            }
            $data['foto_aset'] = null;
        }

        $aset->update($data);

        return redirect()->route('aset.index')
            ->with('success', 'Data aset berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aset = Aset::findOrFail($id);

        // Delete file if exists
        if ($aset->foto_aset) {
            Storage::delete('public/aset/' . $aset->foto_aset);
        }

        $aset->delete();

        return redirect()->route('aset.index')
            ->with('success', 'Data aset berhasil dihapus.');
    }
}