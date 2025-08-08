@extends('layouts.app')

@section('title', 'Data Pestisida')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Data Pestisida</h2>
        <a href="{{ route('pestisida.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Tambah Pestisida
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal Pakai</th>
                    <th>Jenis</th>
                    <th>Dosis Pakai</th>
                    <th>Musim Tanam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pestisidas as $index => $pestisida)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pestisida->pestisida_tanggal_pakai }}</td>
                    <td>{{ $pestisida->pestisida_jenis }}</td>
                    <td>{{ $pestisida->pestisida_dosis_pakai }}</td>
                    <td>{{ $pestisida->musimTanam->mt_komoditas }}</td>
                    <td>
                        <a href="{{ route('pestisida.edit', $pestisida->pestisida_id) }}" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form action="{{ route('pestisida.destroy', $pestisida->pestisida_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
