@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4"><i class="fas fa-users"></i> Data Pengguna</h1>
    <a href="{{ route('pengguna.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Pengguna
    </a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Lokasi</th>
                <th>Peran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->pengguna_nama }}</td>
                <td>{{ $p->pengguna_email }}</td>
                <td>{{ $p->pengguna_lokasi }}</td>
                <td>{{ $p->peran->peran_nama }}</td>
                <td>
                    <a href="{{ route('pengguna.edit', $p->pengguna_id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('pengguna.destroy', $p->pengguna_id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
