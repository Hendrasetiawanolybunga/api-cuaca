<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Ambil user yang baru login atau register
        $user = Auth::user();

        // Cek peran user dan arahkan sesuai
        if ($user->pengguna_peran === 'admin') {
            return route('login');
        }

        if ($user->pengguna_peran === 'penyuluh') {
            return route('login');
        }

        if ($user->pengguna_peran === 'petani') {
            return route('login');
        }

        // Default kalau tidak ada peran cocok
        return redirect('/login');
    }
}
