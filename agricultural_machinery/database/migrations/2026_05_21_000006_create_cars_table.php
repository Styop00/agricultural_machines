<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('manufacturer_id')->constrained()->restrictOnDelete();
            $table->foreignId('machine_model_id')->constrained()->restrictOnDelete();
            $table->unsignedSmallInteger('year');
            $table->string('stock')->unique();
            $table->unsignedInteger('odometer')->nullable();
            $table->string('engine')->nullable();
            $table->decimal('price', 12, 2);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['manufacturer_id', 'machine_model_id']);
            $table->index(['year', 'price']);
        });

        Schema::create('car_category', function (Blueprint $table): void {
            $table->foreignId('car_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->primary(['car_id', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_category');
        Schema::dropIfExists('cars');
    }
};
