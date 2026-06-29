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
