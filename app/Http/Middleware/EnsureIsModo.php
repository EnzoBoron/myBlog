<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Closure;

class EnsureIsModo
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->hasRole('modo')) {
            abort(403, 'Accès interdit');
        }
        return $next($request);
    }
}
