<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                if ($user->pengguna_peran === 'admin') {
                    return redirect()->route('login');
                }

                if ($user->pengguna_peran === 'penyuluh') {
                    return redirect()->route('login');
                }

                if ($user->pengguna_peran === 'petani') {
                    return redirect()->route('login');
                }

                return redirect('/');
            }
        }

        return $next($request);
    }
}
