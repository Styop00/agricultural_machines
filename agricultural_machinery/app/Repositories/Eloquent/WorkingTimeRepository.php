<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\WorkingTime;
use App\Repositories\Contracts\WorkingTimeRepositoryInterface;

final class WorkingTimeRepository extends BaseRepository implements WorkingTimeRepositoryInterface
{
    protected function modelClass(): string
    {
        return WorkingTime::class;
    }
}
