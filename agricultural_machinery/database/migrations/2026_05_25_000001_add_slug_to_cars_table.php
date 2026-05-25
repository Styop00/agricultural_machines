<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table): void {
            $table->string('slug')->nullable()->after('stock');
        });

        DB::table('cars')
            ->join('manufacturers', 'cars.manufacturer_id', '=', 'manufacturers.id')
            ->join('machine_models', 'cars.machine_model_id', '=', 'machine_models.id')
            ->select([
                'cars.id',
                'cars.year',
                'cars.stock',
                'manufacturers.name as manufacturer_name',
                'machine_models.name as model_name',
            ])
            ->orderBy('cars.id')
            ->get()
            ->each(function ($car): void {
                $category = DB::table('car_category')
                    ->join('categories', 'car_category.category_id', '=', 'categories.id')
                    ->where('car_category.car_id', $car->id)
                    ->orderBy('categories.name')
                    ->value('categories.name') ?? 'inventory';

                DB::table('cars')
                    ->where('id', $car->id)
                    ->update([
                        'slug' => Str::slug(implode('-', [
                            $category,
                            $car->manufacturer_name,
                            $car->model_name,
                            $car->year,
                            $car->stock,
                        ])),
                    ]);
            });

        Schema::table('cars', function (Blueprint $table): void {
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table): void {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
