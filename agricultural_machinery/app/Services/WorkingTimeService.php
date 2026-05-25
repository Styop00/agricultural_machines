<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\WorkingTimeRepositoryInterface;

final readonly class WorkingTimeService extends BaseCrudService
{
    public function __construct(WorkingTimeRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }
}
