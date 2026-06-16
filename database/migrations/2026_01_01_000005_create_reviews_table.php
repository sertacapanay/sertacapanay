<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void { Schema::create('reviews', function (Blueprint $table) { $table->id(); $table->string('name'); $table->integer('rating')->default(5); $table->string('tour_name_tr')->nullable(); $table->string('tour_name_en')->nullable(); $table->text('comment_tr')->nullable(); $table->text('comment_en')->nullable(); $table->boolean('is_active')->default(true); $table->timestamps(); }); } public function down(): void { Schema::dropIfExists('reviews'); } };
