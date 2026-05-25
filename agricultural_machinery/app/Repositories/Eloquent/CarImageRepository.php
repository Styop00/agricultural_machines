<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\CarImage;
use App\Repositories\Contracts\CarImageRepositoryInterface;

final class CarImageRepository extends BaseRepository implements CarImageRepositoryInterface
{
    public function clearPrimaryForCar(int $carId, ?int $exceptImageId = null): void
    {
        $query = CarImage::query()
            ->where('car_id', $carId)
            ->where('is_primary', true);

        if ($exceptImageId !== null) {
            $query->whereKeyNot($exceptImageId);
        }

        $query->update(['is_primary' => false]);
    }

    protected function modelClass(): string
    {
        return CarImage::class;
    }
}
