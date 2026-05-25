<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\CompanyRepositoryInterface;

final readonly class CompanyService extends BaseCrudService
{
    public function __construct(CompanyRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }
}
