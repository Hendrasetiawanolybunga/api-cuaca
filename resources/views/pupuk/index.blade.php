@extends('layouts.app')

@section('title', 'Data Pupuk')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Data Pupuk</h2>
        <a href="{{ route('pupuk.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Tambah Pupuk
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
                    <th>Jumlah Pakai</th>
                    <th>Musim Tanam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pupuks as $index => $pupuk)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pupuk->pupuk_tanggal_pakai }}</td>
                    <td>{{ $pupuk->pupuk_jenis }}</td>
                    <td>{{ $pupuk->pupuk_jumlah_pakai }}</td>
                    <td>{{ $pupuk->musimTanam->mt_komoditas }}</td>
                    <td>
                        <a href="{{ route('pupuk.edit', $pupuk->pupuk_id) }}" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form action="{{ route('pupuk.destroy', $pupuk->pupuk_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
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
