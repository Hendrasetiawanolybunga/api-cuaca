<?php

namespace App\Http\Controllers;

use App\Models\Pestisida;
use App\Models\MusimTanam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PestisidaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->pengguna_peran === 'petani') {
            // Petani hanya lihat pestisida dari musim tanam milik kebunnya sendiri
            $data = Pestisida::with('musimTanam.kebun')->whereHas('musimTanam.kebun', function ($query) use ($user) {
                    $query->where('pengguna_id', $user->pengguna_id);
                })->latest()->paginate(10);
        } else {
            // Admin/Penyuluh lihat semua
            $data = Pestisida::with('musimTanam.kebun')->latest()->paginate(10);
        }

        return view('pestisida.index', compact('data'));
    }

    public function create()
    {
        $musimTanam = MusimTanam::all();
        return view('pestisida.create', compact('musimTanam'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pestisida_tanggal_pakai' => 'required|date',
            'pestisida_jenis' => 'required|string|max:255',
            'pestisida_dosis_pakai' => 'required|string|max:255',
            'mt_id' => 'required|exists:musim_tanam,mt_id'
        ]);

        Pestisida::create($request->all());
        return redirect()->route('pestisida.index')->with('success', 'Pestisida berhasil ditambahkan');
    }

    public function edit(Pestisida $pestisida)
    {
        $musimTanam = MusimTanam::all();
        return view('pestisida.edit', compact('pestisida', 'musimTanam'));
    }

    public function update(Request $request, Pestisida $pestisida)
    {
        $request->validate([
            'pestisida_tanggal_pakai' => 'required|date',
            'pestisida_jenis' => 'required|string|max:255',
            'pestisida_dosis_pakai' => 'required|string|max:255',
            'mt_id' => 'required|exists:musim_tanam,mt_id'
        ]);

        $pestisida->update($request->all());
        return redirect()->route('pestisida.index')->with('success', 'Pestisida berhasil diperbarui');
    }

    public function destroy(Pestisida $pestisida)
    {
        $pestisida->delete();
        return redirect()->route('pestisida.index')->with('success', 'Pestisida berhasil dihapus');
    }
}
