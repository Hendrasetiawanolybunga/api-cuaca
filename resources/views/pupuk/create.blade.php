@extends('layouts.app')

@section('title', 'Tambah Pupuk')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-3">Tambah Pupuk</h2>
    <form action="{{ route('pupuk.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tanggal Pakai</label>
            <input type="date" name="pupuk_tanggal_pakai" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Pupuk</label>
            <input type="text" name="pupuk_jenis" class="form-control" placeholder="Masukkan jenis pupuk" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah Pakai</label>
            <input type="number" step="0.01" name="pupuk_jumlah_pakai" class="form-control" placeholder="Masukkan jumlah pakai" required>
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
        <a href="{{ route('pupuk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
