<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('login-form');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function login(Request $request)
    {
        // Validasi input wajib diisi
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:3',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 3 karakter.',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // Cek apakah password mengandung huruf kapital
        if (!preg_match('/[A-Z]/', $password)) {
            return back()->withErrors([
                'password' => 'Password harus mengandung minimal satu huruf kapital.',
            ])->withInput();
        }

        // Cek data login sederhana (misalnya user: admin, pass: Admin123)
        if ($username === 'syabil' && $password === 'Admin123') {
            return redirect('/home')->with('success', 'Selamat datang, ' . $username . '!');
        }

        // Jika gagal
        return back()->withErrors([
            'login_error' => 'Username atau password salah. Silakan coba lagi.',
        ])->withInput();
    }

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
