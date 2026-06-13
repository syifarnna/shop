<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Wajib dipanggil untuk mengenkripsi password
use App\Models\User; // Wajib dipanggil untuk memasukkan data ke tabel users

class AuthController extends Controller
{
    // --- BAGIAN LOGIN --- //
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // --- BAGIAN REGISTER --- //

    // 1. Menampilkan halaman form register
    public function showRegister()
    {
        return view('auth.register');
    }

    // 2. Memproses data pendaftaran
    public function register(Request $request)
    {
        // Validasi data: nama wajib diisi, email harus unik (belum pernah dipakai)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8' // Minimal 8 karakter
        ]);

        // Masukkan data ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password WAJIB di-hash demi keamanan!
        ]);

        // Setelah berhasil buat akun, langsung otomatiskan login
        Auth::login($user);

        // Arahkan ke dashboard
        return redirect('/dashboard');
    }
}