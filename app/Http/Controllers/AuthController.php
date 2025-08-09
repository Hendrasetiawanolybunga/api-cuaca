<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class AuthController extends Controller
{
    /**
     * Menampilkan form login
     */
    public function showLoginForm()
    {   
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'peran' => ['required'],
        ]);

        // Menyesuaikan kredensial untuk model Pengguna
        $credentials = [
            'pengguna_email' => $request->email,
            'password' => $request->password,
            'pengguna_peran' => $request->peran
        ];

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang dimasukkan tidak valid.',
        ])->withInput($request->except('password'));
    }

    /**
     * Menampilkan form register
     */
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.register');
    }

    /**
     * Proses registrasi
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pengguna,pengguna_email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Pengguna::create([
            'pengguna_nama' => $request->name,
            'pengguna_email' => $request->email,
            'pengguna_password' => Hash::make($request->password),
            'pengguna_peran' => 'petani', // Default role
            'pengguna_lokasi' => 'Belum diatur', // Default location
        ]);

        Auth::login($user);

        return redirect('/');
    }

    /**
     * Proses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}