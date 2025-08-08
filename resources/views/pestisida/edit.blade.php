@extends('layouts.app')

@section('title', 'Edit Pestisida')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-3">Edit Pestisida</h2>
    <form action="{{ route('pestisida.update', $pestisida->pestisida_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Tanggal Pakai</label>
            <input type="date" name="pestisida_tanggal_pakai" value="{{ $pestisida->pestisida_tanggal_pakai }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Pestisida</label>
            <input type="text" name="pestisida_jenis" value="{{ $pestisida->pestisida_jenis }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Dosis Pakai</label>
            <input type="text" name="pestisida_dosis_pakai" value="{{ $pestisida->pestisida_dosis_pakai }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Musim Tanam</label>
            <select name="mt_id" class="form-select" required>
                @foreach($musimTanams as $mt)
                    <option value="{{ $mt->mt_id }}" {{ $mt->mt_id == $pestisida->mt_id ? 'selected' : '' }}>
                        {{ $mt->mt_komoditas }} - {{ $mt->kebun->kebun_nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
        <a href="{{ route('pestisida.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
