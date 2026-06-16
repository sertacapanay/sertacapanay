<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void { Schema::create('flights', function (Blueprint $table) { $table->id(); $table->string('airline')->nullable(); $table->string('flight_number')->nullable(); $table->string('from_city')->nullable(); $table->string('to_city')->nullable(); $table->date('flight_date')->nullable(); $table->integer('distance_km')->nullable(); $table->text('notes_tr')->nullable(); $table->text('notes_en')->nullable(); $table->timestamps(); }); } public function down(): void { Schema::dropIfExists('flights'); } };
