@extends('layouts.app')

@section('title', 'Data Musim Tanam')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Musim Tanam</h4>
    <a href="{{ route('musimtanam.create') }}" class="btn btn-primary">
        <i class="fa fa-plus"></i> Tambah Musim Tanam
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tanggal Tanam</th>
            <th>Tanggal Panen</th>
            <th>Komoditas</th>
            <th>Kebun</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($musimtanam as $mt)
        <tr>
            <td>{{ $mt->mt_id }}</td>
            <td>{{ $mt->mt_tanggal_tanam }}</td>
            <td>{{ $mt->mt_tanggal_panen }}</td>
            <td>{{ $mt->mt_komoditas }}</td>
            <td>{{ $mt->kebun->kebun_nama }}</td>
            <td>
                <a href="{{ route('musimtanam.edit', $mt->mt_id) }}" class="btn btn-warning btn-sm">
                    <i class="fa fa-edit"></i>
                </a>
                <form action="{{ route('musimtanam.destroy', $mt->mt_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center">Belum ada data</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
