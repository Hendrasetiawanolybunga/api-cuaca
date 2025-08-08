@extends('layouts.app')

@section('title', 'Tambah Musim Tanam')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <h2><i class="fa-solid fa-seedling"></i> Tambah Musim Tanam</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('musim-tanam.index') }}">Musim Tanam</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Form Container -->
<div class="form-container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <i class="fa-solid fa-triangle-exclamation me-2"></i> Terdapat kesalahan pada input:
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('musim-tanam.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Tanam</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-calendar-plus"></i></span>
                    <input type="date" name="mt_tanggal_tanam" class="form-control @error('mt_tanggal_tanam') is-invalid @enderror" value="{{ old('mt_tanggal_tanam') }}" required>
                    @error('mt_tanggal_tanam')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Panen</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-calendar-check"></i></span>
                    <input type="date" name="mt_tanggal_panen" class="form-control @error('mt_tanggal_panen') is-invalid @enderror" value="{{ old('mt_tanggal_panen') }}" required>
                    @error('mt_tanggal_panen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Komoditas</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-wheat-awn"></i></span>
                    <input type="text" name="mt_komoditas" class="form-control @error('mt_komoditas') is-invalid @enderror" value="{{ old('mt_komoditas') }}" placeholder="Masukkan jenis komoditas" required>
                    @error('mt_komoditas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <label class="form-label">Kebun</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-leaf"></i></span>
                    <select name="kebun_id" class="form-select @error('kebun_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kebun --</option>
                        @foreach($kebun as $k)
                        <option value="{{ $k->kebun_id }}" {{ old('kebun_id') == $k->kebun_id ? 'selected' : '' }}>{{ $k->kebun_nama }}</option>
                        @endforeach
                    </select>
                    @error('kebun_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">
                <i class="fa-solid fa-save me-2"></i> Simpan
            </button>
            <a href="{{ route('musim-tanam.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </form>
</div>
@endsection
