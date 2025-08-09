<?php

namespace App\Http\Controllers;

use App\Models\Pupuk;
use App\Models\MusimTanam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PupukController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->pengguna_peran === 'petani') {
            // Petani hanya lihat pupuk dari musim tanam milik kebunnya sendiri
            $data = Pupuk::with('musimTanam.kebun')->whereHas('musimTanam.kebun', function ($query) use ($user) {
                    $query->where('pengguna_id', $user->pengguna_id);
                })->latest()->paginate(10);
        } else {
            // Admin/Penyuluh lihat semua
            $data = Pupuk::with('musimTanam.kebun')->latest()->paginate(10);
        }

        return view('pupuk.index', compact('data'));
    }

    public function create()
    {
        $musimTanam = MusimTanam::all();
        return view('pupuk.create', compact('musimTanam'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pupuk_tanggal_pakai' => 'required|date',
            'pupuk_jenis' => 'required|string|max:255',
            'pupuk_jumlah_pakai' => 'required|string|max:255',
            'mt_id' => 'required|exists:musim_tanam,mt_id'
        ]);

        Pupuk::create($request->all());
        return redirect()->route('pupuk.index')->with('success', 'Pupuk berhasil ditambahkan');
    }

    public function edit(Pupuk $pupuk)
    {
        $musimTanam = MusimTanam::all();
        return view('pupuk.edit', compact('pupuk', 'musimTanam'));
    }

    public function update(Request $request, Pupuk $pupuk)
    {
        $request->validate([
            'pupuk_tanggal_pakai' => 'required|date',
            'pupuk_jenis' => 'required|string|max:255',
            'pupuk_jumlah_pakai' => 'required|string|max:255',
            'mt_id' => 'required|exists:musim_tanam,mt_id'
        ]);

        $pupuk->update($request->all());
        return redirect()->route('pupuk.index')->with('success', 'Pupuk berhasil diperbarui');
    }

    public function destroy(Pupuk $pupuk)
    {
        $pupuk->delete();
        return redirect()->route('pupuk.index')->with('success', 'Pupuk berhasil dihapus');
    }
}
