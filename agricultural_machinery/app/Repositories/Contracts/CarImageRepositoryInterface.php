<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface CarImageRepositoryInterface extends CrudRepositoryInterface
{
    public function clearPrimaryForCar(int $carId, ?int $exceptImageId = null): void;
}
