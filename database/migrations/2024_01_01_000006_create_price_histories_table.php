<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price_histories', function (Blueprint $table) {
            $table->id();
            $table->string('make');
            $table->string('model');
            $table->unsignedSmallInteger('year');
            $table->decimal('avg_price', 10, 2);
            $table->unsignedInteger('sample_count')->default(0);
            $table->timestamp('recorded_at');
            $table->timestamps();

            $table->index(['make', 'model', 'year']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_histories');
    }
};
