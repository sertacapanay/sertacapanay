<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            // Sosyal medya
            ['key' => 'social.instagram', 'group' => 'social', 'type' => 'url',   'label_tr' => 'Instagram URL'],
            ['key' => 'social.youtube',   'group' => 'social', 'type' => 'url',   'label_tr' => 'YouTube URL'],
            ['key' => 'social.facebook',  'group' => 'social', 'type' => 'url',   'label_tr' => 'Facebook URL'],
            ['key' => 'social.twitter',   'group' => 'social', 'type' => 'url',   'label_tr' => 'X (Twitter) URL'],
            ['key' => 'social.linkedin',  'group' => 'social', 'type' => 'url',   'label_tr' => 'LinkedIn URL'],
            ['key' => 'social.tiktok',    'group' => 'social', 'type' => 'url',   'label_tr' => 'TikTok URL'],

            // Tasarım
            ['key' => 'design.color_coral',  'group' => 'design', 'type' => 'color', 'label_tr' => 'Ana Renk'],
            ['key' => 'design.color_gold',   'group' => 'design', 'type' => 'color', 'label_tr' => 'Altın Rengi'],
            ['key' => 'design.color_ink',    'group' => 'design', 'type' => 'color', 'label_tr' => 'Yazı Rengi'],
            ['key' => 'design.font_display', 'group' => 'design', 'type' => 'text',  'label_tr' => 'Başlık Fontu'],
            ['key' => 'design.font_ui',      'group' => 'design', 'type' => 'text',  'label_tr' => 'Metin Fontu'],
            ['key' => 'design.custom_css',   'group' => 'design', 'type' => 'code',  'label_tr' => 'Özel CSS'],

            // Hero görseller
            ['key' => 'hero.home',   'group' => 'hero', 'type' => 'image', 'label_tr' => 'Ana Sayfa Hero'],
            ['key' => 'hero.blog',   'group' => 'hero', 'type' => 'image', 'label_tr' => 'Blog Hero'],
            ['key' => 'hero.places', 'group' => 'hero', 'type' => 'image', 'label_tr' => 'Destinasyonlar Hero'],
            ['key' => 'hero.tours',  'group' => 'hero', 'type' => 'image', 'label_tr' => 'Turlar Hero'],
            ['key' => 'hero.guides', 'group' => 'hero', 'type' => 'image', 'label_tr' => 'Rehberler Hero'],
            ['key' => 'hero.shop',   'group' => 'hero', 'type' => 'image', 'label_tr' => 'Çarşı Hero'],
            ['key' => 'hero.about',  'group' => 'hero', 'type' => 'image', 'label_tr' => 'Hakkında Hero'],

            // Analitik
            ['key' => 'analytics.ga_id',     'group' => 'analytics', 'type' => 'text', 'label_tr' => 'Google Analytics ID'],
            ['key' => 'analytics.meta_pixel', 'group' => 'analytics', 'type' => 'text', 'label_tr' => 'Meta Pixel ID'],

            // Reklam
            ['key' => 'ads.adsense_publisher', 'group' => 'ads', 'type' => 'text',     'label_tr' => 'AdSense Publisher ID'],
            ['key' => 'ads.header_script',     'group' => 'ads', 'type' => 'code',     'label_tr' => 'Header Script'],
            ['key' => 'ads.footer_script',     'group' => 'ads', 'type' => 'code',     'label_tr' => 'Footer Script'],

            // Genel
            ['key' => 'site.email',       'group' => 'site', 'type' => 'text',    'label_tr' => 'İletişim E-posta'],
            ['key' => 'site.phone',       'group' => 'site', 'type' => 'text',    'label_tr' => 'Telefon'],
            ['key' => 'site.whatsapp',    'group' => 'site', 'type' => 'text',    'label_tr' => 'WhatsApp'],
            ['key' => 'site.maps_url',    'group' => 'site', 'type' => 'url',     'label_tr' => 'Google Maps URL'],
            ['key' => 'site.tagline_tr',  'group' => 'site', 'type' => 'text',    'label_tr' => 'Tagline (TR)'],
            ['key' => 'site.tagline_en',  'group' => 'site', 'type' => 'text',    'label_tr' => 'Tagline (EN)'],
            ['key' => 'site.coming_soon', 'group' => 'site', 'type' => 'boolean', 'label_tr' => 'Coming Soon modu'],
        ];

        foreach ($defaults as $i => $row) {
            Setting::firstOrCreate(
                ['key' => $row['key']],
                array_merge($row, ['value' => null, 'sort' => $i])
            );
        }
    }
}
