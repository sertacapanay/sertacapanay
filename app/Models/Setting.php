<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group', 'type', 'label_tr', 'label_en', 'sort'];

    // ── Static helpers ──────────────────────────────────────────────

    public static function get(string $key, mixed $default = null): mixed
    {
        $all = static::allCached();
        return $all[$key] ?? $default;
    }

    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        static::clearCache();
    }

    public static function allCached(): array
    {
        return Cache::remember('site_settings', 3600, function () {
            return static::pluck('value', 'key')->toArray();
        });
    }

    public static function clearCache(): void
    {
        Cache::forget('site_settings');
    }

    public static function group(string $group): array
    {
        $all = static::allCached();
        return collect(static::where('group', $group)->pluck('key'))
            ->mapWithKeys(fn ($k) => [$k => $all[$k] ?? null])
            ->toArray();
    }
}
