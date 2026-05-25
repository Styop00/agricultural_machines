<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Manufacturer;
use App\Repositories\Contracts\ManufacturerRepositoryInterface;

final class ManufacturerRepository extends BaseRepository implements ManufacturerRepositoryInterface
{
    protected function modelClass(): string
    {
        return Manufacturer::class;
    }
}
