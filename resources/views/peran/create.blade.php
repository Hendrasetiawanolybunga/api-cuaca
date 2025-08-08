@extends('layouts.app')
@section('title', 'Tambah Peran')

@section('content')
<h2>Tambah Peran</h2>
<form action="{{ route('peran.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nama Peran</label>
        <input type="text" name="peran_nama" class="form-control" value="{{ old('peran_nama') }}">
        @error('peran_nama') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <button class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
</form>
@endsection
