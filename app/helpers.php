<?php

if (! function_exists('setting')) {
    /**
     * Site ayarı döndür. Örnek: setting('social.instagram')
     */
    function setting(string $key, mixed $default = null): mixed
    {
        return \App\Models\Setting::get($key, $default);
    }
}

if (! function_exists('txt')) {
    function txt($item, string $field, string $locale = 'tr'): ?string
    {
        if (! $item) {
            return null;
        }

        $localizedField = $field . '_' . $locale;

        return $item->{$localizedField}
            ?? $item->{$field}
            ?? null;
    }
}

if (! function_exists('sanitizeHtml')) {
    function sanitizeHtml(?string $html): string
    {
        if (! $html) {
            return '';
        }

        $allowed = '<p><br><strong><b><em><i><a><ul><ol><li><h2><h3><h4><blockquote><img>';
        $clean = strip_tags($html, $allowed);
        $clean = preg_replace('/\s+on\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $clean);
        $clean = preg_replace('/(href|src)\s*=\s*("|\')\s*javascript:[^"\']*\2/i', '$1=$2#$2', $clean);

        return $clean;
    }
}

if (! function_exists('obfuscateEmail')) {
    /**
     * E-posta adresini spam scraper'lardan gizler. HTML kaynağında düz metin
     * e-posta bırakmaz; XOR + hex ile kodlar, gerçek link JS ile sayfa
     * yüklenince oluşturulur (Cloudflare email-protection tekniğiyle aynı mantık).
     */
    function obfuscateEmail(string $email, ?string $label = null): string
    {
        $label = $label ?? $email;
        $key   = random_int(1, 255);

        $encode = function (string $value) use ($key): string {
            $out = '';
            foreach (str_split($value) as $char) {
                $out .= sprintf('%02x', ord($char) ^ $key);
            }
            return $out;
        };

        $keyHex = sprintf('%02x', $key);

        return '<a href="#" class="cf-email" data-cfe="' . $keyHex . $encode($email) . '" data-cfl="' . $keyHex . $encode($label) . '">[protected]</a>';
    }
}
