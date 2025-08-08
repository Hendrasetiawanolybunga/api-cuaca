@extends('layouts.app')

@section('title', 'Data Pengguna')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <h2><i class="fa-solid fa-users"></i> Data Pengguna</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Action Button -->
<div class="action-button d-flex justify-content-end mb-3">
    <a href="{{ route('pengguna.create') }}" class="btn btn-success">
        <i class="fa-solid fa-plus me-2"></i> Tambah Pengguna
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">
    <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
</div>
@endif

<!-- Table Container -->
<div class="table-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="20%">Nama</th>
                <th width="20%">Email</th>
                <th width="20%">Lokasi</th>
                <th width="15%">Peran</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->pengguna_nama }}</td>
                <td>{{ $p->pengguna_email }}</td>
                <td>{{ $p->pengguna_lokasi }}</td>
                <td>{{ $p->pengguna_peran }}</td>
                <td>
                    <a href="{{ route('pengguna.edit', $p->pengguna_id) }}" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-edit"></i>
                    </a>
                    <form action="{{ route('pengguna.destroy', $p->pengguna_id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data pengguna</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="pagination-container">
    {{ $data->links() }}
</div>
@endsection
