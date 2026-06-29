<?php

if (! function_exists('setting')) {
    /**
     * Site ayarı döndür.
     * Örnek: setting('social.instagram')
     */
    function setting(string $key, mixed $default = null): mixed
    {
        return \App\Models\Setting::get($key, $default);
    }
}
