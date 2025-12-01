<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsTeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // korisnik mora biti prijavljen i imati ulogu 'nastavnik'
        if (!auth()->check() || auth()->user()->role !== 'nastavnik') {
            abort(403, 'Access denied – Nastavnici only.');
        }

        return $next($request);
    }
}
