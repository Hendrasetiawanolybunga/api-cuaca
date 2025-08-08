@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <h2><i class="fa-solid fa-user-edit"></i> Edit Pengguna</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pengguna.index') }}">Pengguna</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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

        <form action="{{ route('pengguna.update', $pengguna->pengguna_id) }}" method="POST">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" name="pengguna_nama"
                            class="form-control @error('pengguna_nama') is-invalid @enderror"
                            value="{{ old('pengguna_nama', $pengguna->pengguna_nama) }}"
                            placeholder="Masukkan nama pengguna" required>
                        @error('pengguna_nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" name="pengguna_email"
                            class="form-control @error('pengguna_email') is-invalid @enderror"
                            value="{{ old('pengguna_email', $pengguna->pengguna_email) }}" placeholder="Masukkan email"
                            required>
                        @error('pengguna_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="pengguna_password"
                            class="form-control @error('pengguna_password') is-invalid @enderror"
                            placeholder="Masukkan password baru">
                        @error('pengguna_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Lokasi</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                        <input type="text" name="pengguna_lokasi"
                            class="form-control @error('pengguna_lokasi') is-invalid @enderror"
                            value="{{ old('pengguna_lokasi', $pengguna->pengguna_lokasi) }}" placeholder="Masukkan lokasi"
                            required>
                        @error('pengguna_lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Peran</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user-tag"></i></span>
                        <select name="pengguna_peran" class="form-select @error('pengguna_peran') is-invalid @enderror"
                            required>
                            <option value="admin"
                                {{ old('pengguna_peran', $pengguna->pengguna_peran) == 'admin' ? 'selected' : '' }}>Admin
                            </option>
                            <option value="penyuluh"
                                {{ old('pengguna_peran', $pengguna->pengguna_peran) == 'penyuluh' ? 'selected' : '' }}>
                                Penyuluh</option>
                            <option value="petani"
                                {{ old('pengguna_peran', $pengguna->pengguna_peran) == 'petani' ? 'selected' : '' }}>Petani
                            </option>
                            {{-- @foreach ($peran as $pr)
                        <option value="{{ $pr->peran_id }}" {{ old('peran_id', $pengguna->peran_id) == $pr->peran_id ? 'selected' : '' }}>
                            {{ $pr->peran_nama }}
                        </option>
                        @endforeach --}}
                        </select>
                        @error('pengguna_peran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-save me-2"></i> Update
                </button>
                <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </form>
    </div>
@endsection
