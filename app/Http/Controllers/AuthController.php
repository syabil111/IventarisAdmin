<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('pages.auth.auth');
    }

    public function showRegister()
    {
        return view('pages.auth.auth');
    }

    public function login(Request $request)
    {
        // Debug: log attempt
        Log::info('Login attempt:', $request->all());

        // Validasi
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        // CARA 1: Menggunakan Auth::attempt() (Recommended - sudah otomatis Hash::check())
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            Log::info('Login successful for: ' . $request->email);

            return redirect()->route('home')->with('success', 'Login berhasil!');
        }

        // CARA 2: Manual Hash::check() (jika ingin kontrol lebih detail)
        // $user = User::where('email', $request->email)->first();

        // if ($user && Hash::check($request->password, $user->password)) {
        //     Auth::login($user, $request->remember);
        //     $request->session()->regenerate();
        //     Log::info('Login successful for: ' . $request->email);

        //     return redirect()->route('home')->with('success', 'Login berhasil!');
        // }

        // Jika gagal
        Log::warning('Login failed for: ' . $request->email);
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->except('password'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'confirmed'
            ],
        ], [
            'password.min' => 'Password minimal :min karakter 8.',
            'password.regex' => 'Password harus mengandung minimal 1 huruf kapital (A-Z).',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Auto login setelah register (optional)
        // Auth::login($user);

        // Redirect ke Login + pesan sukses
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout!');
    }

    // 🔐 **TAMBAHAN: FUNCTION UNTUK UPDATE PASSWORD (jika diperlukan)**
    public function showChangePassword()
    {
        return view('auth.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'confirmed'
            ],
        ], [
            'new_password.regex' => 'Password baru harus mengandung minimal 1 huruf kapital (A-Z).',
        ]);

        $user = Auth::user();

        // 🔑 **VERIFIKASI PASSWORD LAMA DENGAN Hash::check()**
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini salah.'
            ])->withInput();
        }

        // Update password baru


        return back()->with('success', 'Password berhasil diubah!');
    }

    // 🔐 **TAMBAHAN: FUNCTION UNTUK VERIFIKASI PASSWORD MANUAL**
    public function verifyPassword(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        $user = Auth::user();

        // 🔑 **PENGGUNAAN Hash::check() UNTUK VERIFIKASI**
        if (Hash::check($request->password, $user->password)) {
            return response()->json(['valid' => true]);
        }

        return response()->json(['valid' => false], 422);
    }
}
