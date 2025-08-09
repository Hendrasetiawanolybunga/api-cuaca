@extends('layouts.app')

@section('title', 'Tambah Kebun')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <h2><i class="fa-solid fa-plus"></i> Tambah Kebun</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('kebun.index') }}">Kebun</a></li>
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

        <form action="{{ route('kebun.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Kebun</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-leaf"></i></span>
                        <input type="text" name="kebun_nama"
                            class="form-control @error('kebun_nama') is-invalid @enderror" value="{{ old('kebun_nama') }}"
                            placeholder="Masukkan nama kebun" required>
                        @error('kebun_nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Lokasi</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                        <input type="text" name="kebun_lokasi"
                            class="form-control @error('kebun_lokasi') is-invalid @enderror"
                            value="{{ old('kebun_lokasi') }}" placeholder="Masukkan lokasi kebun" required>
                        @error('kebun_lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12 mb-4">
                    <label class="form-label">Pengguna</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>

                        @if (Auth::user()->pengguna_peran === 'petani')
                            {{-- Untuk petani: tampilkan input readonly --}}
                            <input type="text" class="form-control" value="{{ Auth::user()->pengguna_nama }}" readonly>
                            <input type="hidden" name="pengguna_id" value="{{ Auth::user()->pengguna_id }}">
                        @else
                            {{-- Untuk admin/penyuluh: tampilkan dropdown --}}
                            <select name="pengguna_id" class="form-select @error('pengguna_id') is-invalid @enderror"
                                required>
                                <option value="">-- Pilih Pengguna --</option>
                                @foreach ($pengguna as $p)
                                    <option value="{{ $p->pengguna_id }}"
                                        {{ old('pengguna_id') == $p->pengguna_id ? 'selected' : '' }}>
                                        {{ $p->pengguna_nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pengguna_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-save me-2"></i> Simpan
                </button>
                <a href="{{ route('kebun.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </form>
    </div>
@endsection
