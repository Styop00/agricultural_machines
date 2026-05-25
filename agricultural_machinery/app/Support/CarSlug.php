<?php

declare(strict_types=1);

namespace App\Support;

use App\Models\Car;
use Illuminate\Support\Str;

final class CarSlug
{
    public static function make(Car $car): string
    {
        $car->loadMissing(['categories', 'manufacturer', 'machineModel']);

        $category = $car->categories
            ->sortBy('name')
            ->first()?->name ?? 'inventory';

        return Str::slug(implode('-', [
            $category,
            $car->manufacturer?->name,
            $car->machineModel?->name,
            $car->year,
            $car->stock,
        ]));
    }
}
