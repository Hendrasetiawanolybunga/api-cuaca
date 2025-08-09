@extends('layouts.auth')

@section('title', 'Login - FarmEase')

@section('content')
    <div class="auth-card">
        <div class="auth-header">
            <h4 class="mb-0"><i class="fas fa-sign-in-alt me-2"></i>Login</h4>
        </div>
        <div class="auth-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Peran</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user-tag"></i></span>
                        <select name="pengguna_peran" class="form-select @error('pengguna_peran') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Peran --</option>
                            <option value="admin" {{ old('pengguna_peran') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="penyuluh" {{ old('pengguna_peran') == 'penyuluh' ? 'selected' : '' }}>Penyuluh
                            </option>
                            <option value="petani" {{ old('pengguna_peran') == 'petani' ? 'selected' : '' }}>Petani</option>
                            {{-- @foreach ($peran as $p)
                            <option value="{{ $p->pengguna_id }}" {{ old('pengguna_id') == $p->pengguna_id ? 'selected' : '' }}>{{ $p->pengguna_peran }}</option>
                        @endforeach --}}
                        </select>
                        @error('pengguna_peran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Ingat Saya</label>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-auth">Login</button>
                </div>
            </form>

            <div class="mt-4 text-center">
                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
            </div>
        </div>
    </div>
@endsection
