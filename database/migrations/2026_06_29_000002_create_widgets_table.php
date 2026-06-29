<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('widgets', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);                  // Admin etiketi
            $table->string('type', 40);                   // youtube | instagram | html | ad | newsletter | whatsapp | social
            $table->string('title_tr', 200)->nullable();  // Görünen başlık (TR)
            $table->string('title_en', 200)->nullable();  // Görünen başlık (EN)
            $table->json('config')->nullable();            // Tip'e özgü ayarlar (JSON)
            $table->string('position', 60);               // home_hero | sidebar | content_bottom | footer_top | floating | between_posts
            $table->json('pages')->nullable();             // ["all"] veya ["home","blog","places"]
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('widgets');
    }
};
