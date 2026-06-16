<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void { Schema::create('products', function (Blueprint $table) { $table->id(); $table->string('title_tr'); $table->string('title_en')->nullable(); $table->string('slug')->unique(); $table->string('category_tr')->nullable(); $table->string('category_en')->nullable(); $table->string('source_place_tr')->nullable(); $table->string('source_place_en')->nullable(); $table->decimal('price', 12, 2)->nullable(); $table->string('currency')->default('EUR'); $table->string('image')->nullable(); $table->text('description_tr')->nullable(); $table->text('description_en')->nullable(); $table->boolean('is_active')->default(true); $table->timestamps(); }); } public function down(): void { Schema::dropIfExists('products'); } };
