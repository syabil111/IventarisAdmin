<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $admin = "Admin Iventaris";
    $last_login = now()->format('Y-m-d H:i:s');

    $iventaris = [
        "Laptop",
        "Printer",
        "Meja",
        "Kursi"
    ];

    $aset = [
        "Tanah",
        "Bangunan",
        "Kendaraan"
    ];

    return view('admin', compact('admin', 'last_login', 'iventaris', 'aset'));
}

 public function dataAset()
    {
        
        return view('data_aset'); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
