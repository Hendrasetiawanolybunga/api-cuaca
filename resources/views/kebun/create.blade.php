@extends('layouts.app')

@section('content')
<div class="container">
    <h2><i class="fa fa-plus"></i> Tambah Kebun</h2>
    <form action="{{ route('kebun.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Kebun</label>
            <input type="text" name="kebun_nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="kebun_lokasi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Pengguna</label>
            <select name="pengguna_id" class="form-control" required>
                <option value="">-- Pilih Pengguna --</option>
                @foreach($penggunas as $p)
                    <option value="{{ $p->pengguna_id }}">{{ $p->pengguna_nama }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">
            <i class="fa fa-save"></i> Simpan
        </button>
        <a href="{{ route('kebun.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
