<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StripInactiveLocaleMarkup
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $contentType = $response->headers->get('Content-Type', '');
        if (! str_contains($contentType, 'text/html')) {
            return $response;
        }

        $html = $response->getContent();
        if (! $html || (! str_contains($html, 'data-tr') && ! str_contains($html, 'data-en'))) {
            return $response;
        }

        $locale   = $request->segment(1) === 'en' ? 'en' : 'tr';
        $inactive = $locale === 'en' ? 'tr' : 'en';

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);

        foreach ($xpath->query("//*[@data-{$inactive}]") as $node) {
            $node->parentNode?->removeChild($node);
        }
        foreach ($xpath->query("//*[@data-{$locale}]") as $node) {
            $node->removeAttribute("data-{$locale}");
        }

        $output = $dom->saveHTML();
        $output = preg_replace('/^<\?xml[^>]*\?>\s*/', '', $output, 1);

        $response->setContent($output);

        return $response;
    }
}
