@extends('layouts.app')

@section('title', 'Data Kebun')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <h2><i class="fa-solid fa-leaf"></i> Daftar Kebun</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kebun</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Alert Success -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Action Button -->
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('kebun.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-2"></i> Tambah Kebun
    </a>
</div>

<!-- Table Container -->
<div class="table-container">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="30%">Nama Kebun</th>
                <th width="30%">Lokasi</th>
                <th width="20%">Pengguna</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $kebun)
            <tr>
                <td>{{ $kebun->kebun_id }}</td>
                <td>{{ $kebun->kebun_nama }}</td>
                <td>{{ $kebun->kebun_lokasi }}</td>
                <td>{{ $kebun->pengguna->pengguna_nama }}</td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('kebun.edit', $kebun->kebun_id) }}" class="btn btn-warning btn-sm" title="Edit">
                            <i class="fa-solid fa-edit"></i>
                        </a>
                        <form action="{{ route('kebun.destroy', $kebun->kebun_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4">
                    <i class="fa-solid fa-info-circle me-2 text-muted"></i> Tidak ada data kebun
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-4">
    {{ $data->links() }}
</div>
@endsection
