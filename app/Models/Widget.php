<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Widget extends Model
{
    protected $fillable = [
        'name', 'type', 'title_tr', 'title_en', 'config',
        'position', 'pages', 'is_active', 'sort',
    ];

    protected $casts = [
        'config'    => 'array',
        'pages'     => 'array',
        'is_active' => 'boolean',
    ];

    // ── Widget tipleri ──────────────────────────────────────────────

    public const TYPES = [
        'youtube'     => 'YouTube Video / Kanal',
        'instagram'   => 'Instagram Profil Butonu',
        'html'        => 'HTML / Reklam Bloğu',
        'ad'          => 'Google AdSense',
        'newsletter'  => 'Newsletter Formu',
        'whatsapp'    => 'WhatsApp Butonu (floating)',
        'social'      => 'Sosyal Medya İkonları',
    ];

    // ── Pozisyonlar ─────────────────────────────────────────────────

    public const POSITIONS = [
        'home_hero'      => 'Ana Sayfa — Hero altı',
        'sidebar'        => 'Yan Panel (tur/destinasyon detay)',
        'content_bottom' => 'Sayfa İçeriği Altı',
        'between_posts'  => 'Blog Listesi Arasında',
        'footer_top'     => 'Footer Üstü',
        'floating'       => 'Floating (sabit köşe butonu)',
    ];

    // ── Statik sorgular ─────────────────────────────────────────────

    /**
     * Belirli bir pozisyon ve sayfa için aktif widget'ları döndür.
     * Örnek: Widget::forPosition('sidebar', 'tours')
     */
    public static function forPosition(string $position, string $page = 'home'): \Illuminate\Support\Collection
    {
        $key = "widgets_{$position}_{$page}";

        return Cache::remember($key, 3600, function () use ($position, $page) {
            try {
                return static::where('is_active', true)
                    ->where('position', $position)
                    ->where(function ($q) use ($page) {
                        $q->whereNull('pages')
                          ->orWhereJsonContains('pages', 'all')
                          ->orWhereJsonContains('pages', $page);
                    })
                    ->orderBy('sort')
                    ->get();
            } catch (\Throwable $e) {
                // JSON sorgusu desteklenmiyorsa PHP'de filtrele
                \Illuminate\Support\Facades\Log::warning('Widget query fallback: ' . $e->getMessage());
                return static::where('is_active', true)
                    ->where('position', $position)
                    ->orderBy('sort')
                    ->get()
                    ->filter(function ($w) use ($page) {
                        $pages = $w->pages;
                        return empty($pages) || in_array('all', $pages) || in_array($page, $pages);
                    });
            }
        });
    }

    public static function clearCache(): void
    {
        Cache::flush(); // Basit: tüm cache'i temizle
    }
}
