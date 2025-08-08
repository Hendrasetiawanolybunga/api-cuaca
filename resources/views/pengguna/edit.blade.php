@extends('layouts.app')

@section('content')
<div class="container">
    <h1><i class="fas fa-user-edit"></i> Edit Pengguna</h1>
    <form action="{{ route('pengguna.update', $pengguna->pengguna_id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="pengguna_nama" class="form-control" value="{{ $pengguna->pengguna_nama }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="pengguna_email" class="form-control" value="{{ $pengguna->pengguna_email }}" required>
        </div>
        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="pengguna_lokasi" class="form-control" value="{{ $pengguna->pengguna_lokasi }}" required>
        </div>
        <div class="mb-3">
            <label>Peran</label>
            <select name="peran_id" class="form-select" required>
                @foreach($peran as $pr)
                <option value="{{ $pr->peran_id }}" {{ $pengguna->peran_id == $pr->peran_id ? 'selected' : '' }}>
                    {{ $pr->peran_nama }}
                </option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
    </form>
</div>
@endsection
