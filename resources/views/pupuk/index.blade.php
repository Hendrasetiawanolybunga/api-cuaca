@extends('layouts.app')

@section('title', 'Data Pupuk')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <h2><i class="fa-solid fa-leaf me-2"></i> Data Pupuk</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pupuk</li>
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
    <a href="{{ route('pupuk.create') }}" class="btn btn-success">
        <i class="fa-solid fa-plus me-2"></i> Tambah Pupuk
    </a>
</div>

<div class="table-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Tanggal Pakai</th>
                <th width="20%">Jenis</th>
                <th width="20%">Jumlah Pakai</th>
                <th width="20%">Musim Tanam</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $pupuk)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pupuk->pupuk_tanggal_pakai }}</td>
                <td>{{ $pupuk->pupuk_jenis }}</td>
                <td>{{ $pupuk->pupuk_jumlah_pakai }}</td>
                <td>{{ $pupuk->musimTanam->mt_komoditas }}</td>
                <td>
                    <a href="{{ route('pupuk.edit', $pupuk->pupuk_id) }}" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-edit"></i>
                    </a>
                    <form action="{{ route('pupuk.destroy', $pupuk->pupuk_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data pupuk</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
