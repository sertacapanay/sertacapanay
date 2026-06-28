<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ComingSoon
{
    public function handle(Request $request, Closure $next): Response
    {
        $uri = $_SERVER['REQUEST_URI'] ?? $request->getRequestUri();

        if (
            str_contains($uri, 'admin') ||
            str_contains($uri, 'livewire') ||
            $request->is('up')
        ) {
            return $next($request);
        }

        if (config('app.coming_soon', false)) {
            return response()->view('public.coming-soon', [], 200);
        }

        return $next($request);
    }
}
