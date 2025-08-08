<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Peran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $data = Pengguna::with('peran')->latest()->paginate(10);
        return view('pengguna.index', compact('data'));
    }

    public function create()
    {
        $peran = Peran::all();
        return view('pengguna.create', compact('peran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengguna_nama' => 'required|string|max:255',
            'pengguna_email' => 'required|email|unique:pengguna,pengguna_email',
            'pengguna_password' => 'required|min:6',
            'pengguna_lokasi' => 'required|string',
            'peran_id' => 'required|exists:peran,peran_id'
        ]);

        Pengguna::create([
            'pengguna_nama' => $request->pengguna_nama,
            'pengguna_email' => $request->pengguna_email,
            'pengguna_password' => Hash::make($request->pengguna_password),
            'pengguna_lokasi' => $request->pengguna_lokasi,
            'peran_id' => $request->peran_id
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function edit(Pengguna $pengguna)
    {
        $peran = Peran::all();
        return view('pengguna.edit', compact('pengguna', 'peran'));
    }

    public function update(Request $request, Pengguna $pengguna)
    {
        $request->validate([
            'pengguna_nama' => 'required|string|max:255',
            'pengguna_email' => 'required|email|unique:pengguna,pengguna_email,' . $pengguna->pengguna_id . ',pengguna_id',
            'pengguna_lokasi' => 'required|string',
            'peran_id' => 'required|exists:peran,peran_id'
        ]);

        $data = $request->only(['pengguna_nama', 'pengguna_email', 'pengguna_lokasi', 'peran_id']);

        if ($request->filled('pengguna_password')) {
            $data['pengguna_password'] = Hash::make($request->pengguna_password);
        }

        $pengguna->update($data);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil diperbarui');
    }

    public function destroy(Pengguna $pengguna)
    {
        $pengguna->delete();
        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus');
    }
}
