<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsActive
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->isActive) {
            abort(403, 'Votre compte est désactivé. Reglez d\'abord vos abonnements.');
        }

        return $next($request);
    }
}
