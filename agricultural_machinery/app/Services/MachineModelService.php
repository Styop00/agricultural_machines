<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\MachineModelRepositoryInterface;

final readonly class MachineModelService extends BaseCrudService
{
    public function __construct(MachineModelRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }
}
