@extends('layouts.app')

@section('title', 'Edit Pestisida')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <h2><i class="fa-solid fa-edit me-2"></i> Edit Pestisida</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pestisida.index') }}">Pestisida</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Form Container -->
    <div class="form-container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> Terdapat kesalahan pada input:
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pestisida.update', $pestisida->pestisida_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Pakai</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-calendar-day"></i></span>
                        <input type="date" name="pestisida_tanggal_pakai"
                            value="{{ old('pestisida_tanggal_pakai', $pestisida->pestisida_tanggal_pakai) }}"
                            class="form-control @error('pestisida_tanggal_pakai') is-invalid @enderror" required>
                        @error('pestisida_tanggal_pakai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Jenis Pestisida</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-spray-can"></i></span>
                        <input type="text" name="pestisida_jenis"
                            value="{{ old('pestisida_jenis', $pestisida->pestisida_jenis) }}"
                            class="form-control @error('pestisida_jenis') is-invalid @enderror"
                            placeholder="Masukkan jenis pestisida" required>
                        @error('pestisida_jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Dosis Pakai</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-flask"></i></span>
                        <input type="text" name="pestisida_dosis_pakai"
                            value="{{ old('pestisida_dosis_pakai', $pestisida->pestisida_dosis_pakai) }}"
                            class="form-control @error('pestisida_dosis_pakai') is-invalid @enderror"
                            placeholder="Masukkan dosis pakai" required>
                        @error('pestisida_dosis_pakai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Musim Tanam</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-seedling"></i></span>

                        @if (Auth::user()->pengguna_peran === 'petani')
                            @php
                                $mtPetani = $musimTanam->filter(function ($mt) {
                                    return $mt->kebun->pengguna_id === Auth::user()->pengguna_id;
                                });
                            @endphp

                            @if ($mtPetani->count() > 0)
                                <select name="mt_id" class="form-select @error('mt_id') is-invalid @enderror" required>
                                    @foreach ($mtPetani as $mt)
                                        <option value="{{ $mt->mt_id }}"
                                            {{ old('mt_id', $pestisida->mt_id) == $mt->mt_id ? 'selected' : '' }}>
                                            {{ $mt->mt_komoditas }} - {{ $mt->kebun->kebun_nama }}
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <input type="text" class="form-control" value="Tidak ada musim tanam milik Anda"
                                    readonly>
                            @endif
                        @else
                            <select name="mt_id" class="form-select @error('mt_id') is-invalid @enderror" required>
                                @foreach ($musimTanam as $mt)
                                    <option value="{{ $mt->mt_id }}"
                                        {{ old('mt_id', $pestisida->mt_id) == $mt->mt_id ? 'selected' : '' }}>
                                        {{ $mt->mt_komoditas }} - {{ $mt->kebun->kebun_nama }}
                                    </option>
                                @endforeach
                            </select>
                        @endif

                        @error('mt_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-save me-2"></i> Update
                </button>
                <a href="{{ route('pestisida.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </form>
    </div>
@endsection
