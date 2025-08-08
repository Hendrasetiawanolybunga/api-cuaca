@extends('layouts.app')

@section('title', 'Tambah Pupuk')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <h2><i class="fa-solid fa-leaf me-2"></i> Tambah Pupuk</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pupuk.index') }}">Pupuk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>
    </div>
</div>

@if($errors->any())
<div class="alert alert-danger">
    <i class="fa-solid fa-circle-exclamation me-2"></i> Terdapat kesalahan pada input yang diberikan.
</div>
@endif

<div class="form-container">
    <form action="{{ route('pupuk.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tanggal Pakai</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                <input type="date" name="pupuk_tanggal_pakai" value="{{ old('pupuk_tanggal_pakai') }}" class="form-control @error('pupuk_tanggal_pakai') is-invalid @enderror" required>
                @error('pupuk_tanggal_pakai')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Pupuk</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-seedling"></i></span>
                <input type="text" name="pupuk_jenis" value="{{ old('pupuk_jenis') }}" class="form-control @error('pupuk_jenis') is-invalid @enderror" required>
                @error('pupuk_jenis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah Pakai</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-scale-balanced"></i></span>
                <input type="number" step="0.01" name="pupuk_jumlah_pakai" value="{{ old('pupuk_jumlah_pakai') }}" class="form-control @error('pupuk_jumlah_pakai') is-invalid @enderror" required>
                @error('pupuk_jumlah_pakai')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Musim Tanam</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-wheat-awn"></i></span>
                <select name="mt_id" class="form-select @error('mt_id') is-invalid @enderror" required>
                    <option value="">Pilih Musim Tanam</option>
                    @foreach($musimTanam as $mt)
                        <option value="{{ $mt->mt_id }}" {{ old('mt_id') == $mt->mt_id ? 'selected' : '' }}>
                            {{ $mt->mt_komoditas }} - {{ $mt->kebun->kebun_nama }}
                        </option>
                    @endforeach
                </select>
                @error('mt_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('pupuk.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali
            </a>
            <button class="btn btn-success">
                <i class="fa-solid fa-save me-2"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
