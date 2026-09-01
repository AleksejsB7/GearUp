<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('make');
            $table->string('model');
            $table->unsignedSmallInteger('year');
            $table->decimal('price', 10, 2);
            $table->string('fuel_type');
            $table->unsignedInteger('mileage');
            $table->string('vehicle_type')->default('auto');
            $table->decimal('engine_volume', 3, 1)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['make', 'model']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
