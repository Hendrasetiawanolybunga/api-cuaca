@extends('layouts.app')
@section('title', 'Daftar Peran')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <h2><i class="fa-solid fa-user-tag me-2"></i> Daftar Peran</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Peran</li>
            </ol>
        </nav>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">
    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
</div>
@endif

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('peran.create') }}" class="btn btn-success">
        <i class="fa-solid fa-plus me-2"></i> Tambah Peran
    </a>
</div>

<div class="table-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th width="10%">ID</th>
                <th width="70%">Nama Peran</th>
                <th width="20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @if($data->count() > 0)
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->peran_id }}</td>
                    <td>{{ $item->peran_nama }}</td>
                    <td>
                        <a href="{{ route('peran.edit', $item->peran_id) }}" class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-edit"></i>
                        </a>
                        <form action="{{ route('peran.destroy', $item->peran_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3" class="text-center">Tidak ada data peran</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>

<div class="pagination-container">
    {{ $data->links() }}
</div>
@endsection
