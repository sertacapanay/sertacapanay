<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // posts: sorgu sıklığı yüksek kolonlar
        Schema::table('posts', function (Blueprint $table) {
            $table->index(['is_published', 'published_at'], 'posts_published_idx');
        });

        // products: aktif ürün sorguları
        Schema::table('products', function (Blueprint $table) {
            $table->index('is_active', 'products_active_idx');
        });

        // places: aktif yer sorguları
        Schema::table('places', function (Blueprint $table) {
            $table->index('is_active', 'places_active_idx');
        });

        // tours: aktif tur sorguları
        Schema::table('tours', function (Blueprint $table) {
            $table->index('is_active', 'tours_active_idx');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex('posts_published_idx');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('products_active_idx');
        });
        Schema::table('places', function (Blueprint $table) {
            $table->dropIndex('places_active_idx');
        });
        Schema::table('tours', function (Blueprint $table) {
            $table->dropIndex('tours_active_idx');
        });
    }
};
