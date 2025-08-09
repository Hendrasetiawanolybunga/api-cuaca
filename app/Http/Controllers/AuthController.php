<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;
use App\Models\Peran;

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
        // Ambil data peran dari database (termasuk admin untuk ditampilkan di dropdown)
        $peran = Peran::whereIn('peran_nama', ['penyuluh', 'petani'])->get();
        return view('auth.login', compact('peran'));
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'peran_id' => ['nullable', 'exists:peran,peran_id'],
        ]);

        // Cari pengguna berdasarkan email
        $pengguna = Pengguna::where('pengguna_email', $request->email)->first();
        
        // Jika peran_id tidak dipilih, gunakan peran admin sebagai default
        if (empty($request->peran_id)) {
            $adminRole = Peran::where('peran_nama', 'admin')->first();
            if ($adminRole) {
                $request->merge(['peran_id' => $adminRole->peran_id]);
            }
        }
        
        // Jika pengguna ditemukan, periksa apakah peran_id sesuai
        if ($pengguna && $request->peran_id && $pengguna->peran_id != $request->peran_id) {
            return back()->withErrors([
                'peran_id' => 'Peran yang dipilih tidak sesuai dengan akun Anda.',
            ])->withInput($request->except('password'));
        }
        
        // Menyesuaikan kredensial untuk model Pengguna
        $credentials = [
            'pengguna_email' => $request->email,
            'password' => $request->password,
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
        // Ambil data peran dari database (hanya Penyuluh dan Petani)
        $peran = Peran::whereIn('peran_nama', ['penyuluh', 'petani'])->get();
        return view('auth.register', compact('peran'));
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
            'peran_id' => ['required', 'exists:peran,peran_id'],
            'lokasi' => ['required', 'string', 'max:255'],
        ]);

        // Ambil nama peran berdasarkan peran_id
        $peranData = Peran::find($request->peran_id);
        
        $user = Pengguna::create([
            'pengguna_nama' => $request->name,
            'pengguna_email' => $request->email,
            'pengguna_password' => Hash::make($request->password),
            'peran_id' => $request->peran_id,
            'pengguna_peran' => $peranData->peran_nama,
            'pengguna_lokasi' => $request->lokasi,
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