<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\ManufacturerRepositoryInterface;

final readonly class ManufacturerService extends BaseCrudService
{
    public function __construct(ManufacturerRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }
}
