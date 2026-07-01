<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cruises', function (Blueprint $table) {
            $table->id();
            $table->string('title_tr');
            $table->string('title_en')->nullable();
            $table->string('slug')->unique();
            $table->string('ship_name')->nullable();
            $table->string('cruise_line')->nullable();
            $table->string('from_port_tr')->nullable();
            $table->string('from_port_en')->nullable();
            $table->string('to_port_tr')->nullable();
            $table->string('to_port_en')->nullable();
            $table->string('country_tr')->nullable();
            $table->string('country_en')->nullable();
            $table->integer('nights')->nullable();
            $table->date('departure_date')->nullable();
            $table->string('cover_image')->nullable();
            $table->text('short_description_tr')->nullable();
            $table->text('short_description_en')->nullable();
            $table->longText('description_tr')->nullable();
            $table->longText('description_en')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cruises');
    }
};
