@extends('layouts.app')

@section('title', 'Edit Musim Tanam')

@section('content')
<h4>Edit Musim Tanam</h4>

<form action="{{ route('musimtanam.update', $musimtanam->mt_id) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Tanggal Tanam</label>
        <input type="date" name="mt_tanggal_tanam" value="{{ $musimtanam->mt_tanggal_tanam }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Tanggal Panen</label>
        <input type="date" name="mt_tanggal_panen" value="{{ $musimtanam->mt_tanggal_panen }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Komoditas</label>
        <input type="text" name="mt_komoditas" value="{{ $musimtanam->mt_komoditas }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Kebun</label>
        <select name="kebun_id" class="form-select" required>
            @foreach($kebun as $k)
            <option value="{{ $k->kebun_id }}" {{ $musimtanam->kebun_id == $k->kebun_id ? 'selected' : '' }}>
                {{ $k->kebun_nama }}
            </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
    <a href="{{ route('musimtanam.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
