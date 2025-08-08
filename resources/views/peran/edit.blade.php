@extends('layouts.app')
@section('title', 'Edit Peran')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <h2><i class="fa-solid fa-edit me-2"></i> Edit Peran</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('peran.index') }}">Peran</a></li>
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

    <form action="{{ route('peran.update', $peran->peran_id) }}" method="POST">
        @csrf @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Peran</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user-tag"></i></span>
                    <input type="text" name="peran_nama" class="form-control @error('peran_nama') is-invalid @enderror" value="{{ old('peran_nama', $peran->peran_nama) }}" placeholder="Masukkan nama peran">
                    @error('peran_nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="d-flex gap-2 mt-3">
            <button type="submit" class="btn btn-success">
                <i class="fa-solid fa-save me-2"></i> Update
            </button>
            <a href="{{ route('peran.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </form>
</div>
@endsection
