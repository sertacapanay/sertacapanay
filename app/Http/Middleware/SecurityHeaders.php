<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
        $response->headers->set('X-Permitted-Cross-Domain-Policies', 'none');

        // Content Security Policy
        $csp = implode('; ', [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' cdn.jsdelivr.net unpkg.com",
            "style-src 'self' 'unsafe-inline' fonts.googleapis.com cdn.jsdelivr.net",
            "font-src 'self' fonts.gstatic.com data:",
            "img-src 'self' data: blob: *.sertacapanay.net storage.googleapis.com",
            "media-src 'self'",
            "connect-src 'self'",
            "frame-src 'none'",
            "object-src 'none'",
            "base-uri 'self'",
            "form-action 'self'",
            "upgrade-insecure-requests",
        ]);
        $response->headers->set('Content-Security-Policy', $csp);

        // HSTS — only over HTTPS
        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        return $response;
    }
}
