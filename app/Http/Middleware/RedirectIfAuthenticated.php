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
                if ($request->is('login') || $request->is('register')) {
                    if ($request->user()->role == 'admin') {
                        //dd($request->user()->role);
                        return redirect()->route('admin.index'); // redirect ke halaman beranda admin
                    } elseif ($request->user()->role == 'wali_calon') {
                        //dd($request->user()->role);
                        return redirect()->route('wali.index');
                    } elseif ($request->user()->role == 'siswa') {
                        return back();
                    }
                }
            }
        }

        return $next($request);
    }
}
