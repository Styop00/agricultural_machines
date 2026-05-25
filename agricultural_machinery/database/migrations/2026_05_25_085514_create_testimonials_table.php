<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('context');
            $table->text('quote');
            $table->string('image_url')->nullable();
            $table->string('avatar_url')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_featured')->default(true);
            $table->timestamps();

            $table->index(['is_featured', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
