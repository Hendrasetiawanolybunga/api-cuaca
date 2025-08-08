@extends('layouts.app')
@section('title', 'Edit Peran')

@section('content')
<h2>Edit Peran</h2>
<form action="{{ route('peran.update', $peran->peran_id) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Nama Peran</label>
        <input type="text" name="peran_nama" class="form-control" value="{{ old('peran_nama', $peran->peran_nama) }}">
        @error('peran_nama') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <button class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
</form>
@endsection
