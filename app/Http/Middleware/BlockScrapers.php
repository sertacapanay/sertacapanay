<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockScrapers
{
    // Bilinen scraper/copier user-agent'ları
    protected array $blocked = [
        'httrack', 'webcopier', 'webreaper', 'offline explorer',
        'teleport', 'teleportpro', 'website ripper', 'cyotek',
        'surfoffline', 'sitesniffer', 'sitesucker', 'larbin',
        'libwww-perl', 'lwp-trivial', 'getright', 'scrapy',
        'python-urllib', 'go-http-client', 'java/', 'wget',
        'curl/', 'masscan', 'nikto', 'sqlmap', 'nmap',
        'mj12bot', 'dotbot', 'sistrix', 'blexbot',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $ua = strtolower($request->userAgent() ?? '');

        foreach ($this->blocked as $bot) {
            if (str_contains($ua, $bot)) {
                abort(403, 'Access denied. © Sertac Apanay. Unauthorized copying is prohibited.');
            }
        }

        $response = $next($request);

        // Telif hakkı HTTP başlıkları
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Owner', 'Sertac Apanay');
        $response->headers->set('X-Copyright', '© ' . date('Y') . ' Sertac Apanay. All rights reserved.');

        return $response;
    }
}
