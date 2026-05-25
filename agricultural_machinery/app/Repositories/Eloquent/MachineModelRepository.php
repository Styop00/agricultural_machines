<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\MachineModel;
use App\Repositories\Contracts\MachineModelRepositoryInterface;

final class MachineModelRepository extends BaseRepository implements MachineModelRepositoryInterface
{
    protected function modelClass(): string
    {
        return MachineModel::class;
    }
}
