@extends('layouts.app')
@section('title', 'Daftar Peran')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Daftar Peran</h2>
    <a href="{{ route('peran.create') }}" class="btn btn-primary">
        <i class="fa fa-plus"></i> Tambah Peran
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nama Peran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item->peran_id }}</td>
            <td>{{ $item->peran_nama }}</td>
            <td>
                <a href="{{ route('peran.edit', $item->peran_id) }}" class="btn btn-warning btn-sm">
                    <i class="fa fa-edit"></i>
                </a>
                <form action="{{ route('peran.destroy', $item->peran_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $data->links() }}
@endsection
