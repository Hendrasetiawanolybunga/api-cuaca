@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h2><i class="fa fa-leaf"></i> Daftar Kebun</h2>
        <a href="{{ route('kebun.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Tambah Kebun
        </a>
    </div>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Kebun</th>
                <th>Lokasi</th>
                <th>Pengguna</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kebuns as $kebun)
            <tr>
                <td>{{ $kebun->kebun_id }}</td>
                <td>{{ $kebun->kebun_nama }}</td>
                <td>{{ $kebun->kebun_lokasi }}</td>
                <td>{{ $kebun->pengguna->pengguna_nama }}</td>
                <td>
                    <a href="{{ route('kebun.edit', $kebun->kebun_id) }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('kebun.destroy', $kebun->kebun_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
