<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ComingSoon
{
    public function handle(Request $request, Closure $next): Response
    {
        // Admin paneli ve health check her zaman erişilebilir
        if ($request->is('admin*') || $request->is('up')) {
            return $next($request);
        }

        if (config('app.coming_soon', false)) {
            return response()->view('public.coming-soon', [], 200);
        }

        return $next($request);
    }
}
