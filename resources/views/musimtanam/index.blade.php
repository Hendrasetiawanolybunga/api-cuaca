@extends('layouts.app')

@section('title', 'Data Musim Tanam')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <h2><i class="fa-solid fa-seedling"></i> Data Musim Tanam</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Musim Tanam</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Action Button -->
<div class="action-button mb-3">
    <a href="{{ route('musim-tanam.create') }}" class="btn btn-success">
        <i class="fa-solid fa-plus me-2"></i> Tambah Musim Tanam
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
                <th width="5%">ID</th>
                <th width="20%">Tanggal Tanam</th>
                <th width="20%">Tanggal Panen</th>
                <th width="20%">Komoditas</th>
                <th width="20%">Kebun</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $mt)
            <tr>
                <td>{{ $mt->mt_id }}</td>
                <td>{{ $mt->mt_tanggal_tanam }}</td>
                <td>{{ $mt->mt_tanggal_panen }}</td>
                <td>{{ $mt->mt_komoditas }}</td>
                <td>{{ $mt->kebun->kebun_nama }}</td>
                <td>
                    <a href="{{ route('musim-tanam.edit', $mt->mt_id) }}" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-edit"></i>
                    </a>
                    <form action="{{ route('musim-tanam.destroy', $mt->mt_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="pagination-container">
    {{ $data->links() ?? '' }}
</div>
@endsection
