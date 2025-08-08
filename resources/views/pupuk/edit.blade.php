@extends('layouts.app')

@section('title', 'Edit Pupuk')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-3">Edit Pupuk</h2>
    <form action="{{ route('pupuk.update', $pupuk->pupuk_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Tanggal Pakai</label>
            <input type="date" name="pupuk_tanggal_pakai" value="{{ $pupuk->pupuk_tanggal_pakai }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Pupuk</label>
            <input type="text" name="pupuk_jenis" value="{{ $pupuk->pupuk_jenis }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah Pakai</label>
            <input type="number" step="0.01" name="pupuk_jumlah_pakai" value="{{ $pupuk->pupuk_jumlah_pakai }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Musim Tanam</label>
            <select name="mt_id" class="form-select" required>
                @foreach($musimTanams as $mt)
                    <option value="{{ $mt->mt_id }}" {{ $mt->mt_id == $pupuk->mt_id ? 'selected' : '' }}>
                        {{ $mt->mt_komoditas }} - {{ $mt->kebun->kebun_nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
        <a href="{{ route('pupuk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
