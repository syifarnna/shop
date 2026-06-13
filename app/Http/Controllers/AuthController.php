<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validasi Input Form
        $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|max:50',
        ]);
        
        // 2. Proses Pencocokan Data Login
        if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
            
            // 3. Pengecekan Role
            // Jika role adalah 'customer', arahkan ke halaman /customer
            if (Auth::user()->role == 'customer') { 
                return redirect('/customer'); 
            }
            
            // Jika role BUKAN customer (berarti admin/staff), arahkan ke /dashboard
            return redirect('/dashboard');
        } 
        
        // 4. Jika email/password salah
        return back()->with('failed', 'Invalid email or password');
    }


    public function register(Request $request)
    {
        // 1. Validasi Input Form
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email|max:50',
            'password' => 'required|min:8|max:50',
            'confirm_password' => 'required|same:password',
        ]);
        
        // 2. Proses Pendaftaran User Baru
        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'customer', // Set role default sebagai customer
        ]);
        
        // 3. Redirect ke halaman login dengan pesan sukses
        return redirect('/login')->with('success', 'Registration successful. Please login.');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        
        // Praktik keamanan terbaik Laravel: hapus memori sesi login sebelumnya
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}