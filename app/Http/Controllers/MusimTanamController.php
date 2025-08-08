<?php

namespace App\Http\Controllers;

use App\Models\MusimTanam;
use App\Models\Kebun;
use Illuminate\Http\Request;

class MusimTanamController extends Controller
{
    public function index()
    {
        $data = MusimTanam::with('kebun')->latest()->paginate(10);
        return view('musim_tanam.index', compact('data'));
    }

    public function create()
    {
        $kebun = Kebun::all();
        return view('musim_tanam.create', compact('kebun'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mt_tanggal_tanam' => 'required|date',
            'mt_tanggal_panen' => 'required|date|after:mt_tanggal_tanam',
            'mt_komoditas' => 'required|string|max:255',
            'kebun_id' => 'required|exists:kebun,kebun_id'
        ]);

        MusimTanam::create($request->all());
        return redirect()->route('musim-tanam.index')->with('success', 'Musim tanam berhasil ditambahkan');
    }

    public function edit(MusimTanam $musim_tanam)
    {
        $kebun = Kebun::all();
        return view('musim_tanam.edit', compact('musim_tanam', 'kebun'));
    }

    public function update(Request $request, MusimTanam $musim_tanam)
    {
        $request->validate([
            'mt_tanggal_tanam' => 'required|date',
            'mt_tanggal_panen' => 'required|date|after:mt_tanggal_tanam',
            'mt_komoditas' => 'required|string|max:255',
            'kebun_id' => 'required|exists:kebun,kebun_id'
        ]);

        $musim_tanam->update($request->all());
        return redirect()->route('musim-tanam.index')->with('success', 'Musim tanam berhasil diperbarui');
    }

    public function destroy(MusimTanam $musim_tanam)
    {
        $musim_tanam->delete();
        return redirect()->route('musim-tanam.index')->with('success', 'Musim tanam berhasil dihapus');
    }
}
