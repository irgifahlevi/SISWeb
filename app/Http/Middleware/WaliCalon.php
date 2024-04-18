<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WaliCalon
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika request user adalah staff maka requestnya di teruskan
        if ($request->user()->role == 'wali_calon') {
            return $next($request);
        }

        // Jika request user yang masuk bukan staff maka redirect
        return back();
    }
}
