<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\CarImage;

final class CarImageObserver
{
    public function saving(CarImage $carImage): void
    {
        if (! $carImage->is_primary) {
            return;
        }

        CarImage::query()
            ->where('car_id', $carImage->car_id)
            ->when($carImage->exists, fn ($query) => $query->whereKeyNot($carImage->id))
            ->update(['is_primary' => false]);
    }
}
