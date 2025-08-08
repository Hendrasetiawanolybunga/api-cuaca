<?php

namespace App\Http\Controllers;

use App\Models\Peran;
use Illuminate\Http\Request;

class PeranController extends Controller
{
    public function index()
    {
        $data = Peran::latest()->paginate(10);
        return view('peran.index', compact('data'));
    }

    public function create()
    {
        return view('peran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'peran_nama' => 'required|string|max:255'
        ]);

        Peran::create($request->all());

        return redirect()->route('peran.index')->with('success', 'Data peran berhasil ditambahkan.');
    }

    public function edit(Peran $peran)
    {
        return view('peran.edit', compact('peran'));
    }

    public function update(Request $request, Peran $peran)
    {
        $request->validate([
            'peran_nama' => 'required|string|max:255'
        ]);

        $peran->update($request->all());

        return redirect()->route('peran.index')->with('success', 'Data peran berhasil diupdate.');
    }

    public function destroy(Peran $peran)
    {
        $peran->delete();
        return redirect()->route('peran.index')->with('success', 'Data peran berhasil dihapus.');
    }
}
