@extends('layouts.app')

@section('content')
<div class="container">
    <h1><i class="fas fa-user-plus"></i> Tambah Pengguna</h1>
    <form action="{{ route('pengguna.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="pengguna_nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="pengguna_email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="pengguna_password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="pengguna_lokasi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Peran</label>
            <select name="peran_id" class="form-select" required>
                <option value="">-- Pilih Peran --</option>
                @foreach($peran as $pr)
                <option value="{{ $pr->peran_id }}">{{ $pr->peran_nama }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
    </form>
</div>
@endsection
