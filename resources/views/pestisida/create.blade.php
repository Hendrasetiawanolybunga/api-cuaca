@extends('layouts.app')

@section('title', 'Tambah Pestisida')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-3">Tambah Pestisida</h2>
    <form action="{{ route('pestisida.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tanggal Pakai</label>
            <input type="date" name="pestisida_tanggal_pakai" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Pestisida</label>
            <input type="text" name="pestisida_jenis" class="form-control" placeholder="Masukkan jenis pestisida" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Dosis Pakai</label>
            <input type="text" name="pestisida_dosis_pakai" class="form-control" placeholder="Masukkan dosis pakai" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Musim Tanam</label>
            <select name="mt_id" class="form-select" required>
                <option value="">-- Pilih Musim Tanam --</option>
                @foreach($musimTanams as $mt)
                    <option value="{{ $mt->mt_id }}">{{ $mt->mt_komoditas }} - {{ $mt->kebun->kebun_nama }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        <a href="{{ route('pestisida.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
