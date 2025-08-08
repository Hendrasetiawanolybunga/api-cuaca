@extends('layouts.app')

@section('content')
<div class="container">
    <h2><i class="fa fa-edit"></i> Edit Kebun</h2>
    <form action="{{ route('kebun.update', $kebun->kebun_id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama Kebun</label>
            <input type="text" name="kebun_nama" value="{{ $kebun->kebun_nama }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="kebun_lokasi" value="{{ $kebun->kebun_lokasi }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Pengguna</label>
            <select name="pengguna_id" class="form-control" required>
                @foreach($penggunas as $p)
                    <option value="{{ $p->pengguna_id }}" {{ $p->pengguna_id == $kebun->pengguna_id ? 'selected' : '' }}>
                        {{ $p->pengguna_nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">
            <i class="fa fa-save"></i> Update
        </button>
        <a href="{{ route('kebun.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
