<?php

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
