<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PlatformAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check() || ! Auth::user()->is_platform_admin) {
            abort(403, 'Access denied. Platform admin only.');
        }

        return $next($request);
    }
}
