@extends('layouts.app')

@section('title', 'Data Pestisida')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <h2><i class="fa-solid fa-spray-can-sparkles me-2"></i> Data Pestisida</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pestisida</li>
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
    <a href="{{ route('pestisida.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-2"></i> Tambah Pestisida
    </a>
</div>

<!-- Table Container -->
<div class="table-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Tanggal Pakai</th>
                <th width="20%">Jenis</th>
                <th width="20%">Dosis Pakai</th>
                <th width="20%">Musim Tanam</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $pestisida)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pestisida->pestisida_tanggal_pakai }}</td>
                <td>{{ $pestisida->pestisida_jenis }}</td>
                <td>{{ $pestisida->pestisida_dosis_pakai }}</td>
                <td>{{ $pestisida->musimTanam->mt_komoditas }}</td>
                <td>
                    <a href="{{ route('pestisida.edit', $pestisida->pestisida_id) }}" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-edit"></i>
                    </a>
                    <form action="{{ route('pestisida.destroy', $pestisida->pestisida_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
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
                <td colspan="6" class="text-center py-4">
                    <i class="fa-solid fa-info-circle me-2 text-muted"></i> Tidak ada data pestisida
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
