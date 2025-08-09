<?php

namespace App\Http\Controllers;

use App\Models\Kebun;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KebunController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->pengguna_peran === 'petani') {
            // Petani hanya lihat kebunnya sendiri
            $data = Kebun::with('pengguna')->where('pengguna_id', $user->pengguna_id)->latest()->paginate(10);
        } else {
            // Admin/penyuluh lihat semua kebun
            $data = Kebun::with('pengguna')->latest()->paginate(10);
        }

        return view('kebun.index', compact('data'));
    }

    public function create()
    {
        $pengguna = Pengguna::all();
        return view('kebun.create', compact('pengguna'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kebun_nama' => 'required|string|max:255',
            'kebun_lokasi' => 'required|string',
            'pengguna_id' => 'required|exists:pengguna,pengguna_id'
        ]);

        Kebun::create($request->all());
        return redirect()->route('kebun.index')->with('success', 'Kebun berhasil ditambahkan');
    }

    public function edit(Kebun $kebun)
    {
        $pengguna = Pengguna::all();
        return view('kebun.edit', compact('kebun', 'pengguna'));
    }

    public function update(Request $request, Kebun $kebun)
    {
        $request->validate([
            'kebun_nama' => 'required|string|max:255',
            'kebun_lokasi' => 'required|string',
            'pengguna_id' => 'required|exists:pengguna,pengguna_id'
        ]);

        $kebun->update($request->all());
        return redirect()->route('kebun.index')->with('success', 'Kebun berhasil diperbarui');
    }

    public function destroy(Kebun $kebun)
    {
        $kebun->delete();
        return redirect()->route('kebun.index')->with('success', 'Kebun berhasil dihapus');
    }
}
