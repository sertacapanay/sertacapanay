# Sertac Apanay

Kültürel anlatıcı ve seyahat uzmanı Sertaç Apanay'ın kişisel web sitesi. Laravel + Filament ile geliştirilmiş, Türkçe/İngilizce iki dilli içerik yönetim sistemi.

## Özellikler

- **İki dilli** — Türkçe ve İngilizce (TR/EN) rota yapısı
- **Blog** — Yayımlanma durumu ve kategori filtresi, okuma süresi, ilgili yazılar
- **Yerler** — Ülke filtresi, OpenStreetMap embed, ilgili yerler
- **Turlar** — Ülke filtresi, fiyat/süre kartları, sticky rezervasyon paneli, WhatsApp CTA
- **Admin paneli** — Filament v3 ile içerik yönetimi
- **SEO** — Open Graph, Twitter Card, per-page title/description

## Teknoloji

| Katman | Araç |
|---|---|
| Backend | Laravel 12 |
| Admin | Filament v3 |
| Frontend | Tailwind CSS (CDN), Playfair Display + Inter |
| Veritabanı | SQLite (geliştirme) |

## Kurulum

```bash
git clone https://github.com/sertacapanay/sertacapanay.git
cd sertacapanay

composer install
cp .env.example .env
php artisan key:generate

php artisan migrate
php artisan storage:link

php artisan serve
```

Admin paneli: `http://localhost:8000/admin`

## Yapı

```
app/
├── Http/Controllers/PublicController.php   # Tüm public rotalar
├── Models/                                  # Post · Place · Tour (published/active scope)
└── Filament/Resources/                      # Admin CRUD

resources/views/public/
├── layout.blade.php       # Sticky nav, mobile menu, rich footer
├── home.blade.php         # Hero (cover image), featured places & posts
├── posts/
│   ├── index.blade.php    # Kategori filtresi, kart grid, pagination
│   └── show.blade.php     # Hero, okuma süresi, ilgili yazılar
├── places/
│   ├── index.blade.php    # Ülke filtresi, kart grid
│   └── show.blade.php     # Hero, bölümler, harita, ilgili yerler
└── tours/
    ├── index.blade.php    # Ülke filtresi, fiyat kartları
    └── show.blade.php     # Sticky rezervasyon paneli, WhatsApp
```
