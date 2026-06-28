<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // MySQL 5.x uyumu — utf8mb4 index uzunluğu sınırı
        Schema::defaultStringLength(191);

        // Production'da tüm URL'leri zorla HTTPS yap (Railway proxy arkasında)
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
