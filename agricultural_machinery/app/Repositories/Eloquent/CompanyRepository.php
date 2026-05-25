<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Company;
use App\Repositories\Contracts\CompanyRepositoryInterface;

final class CompanyRepository extends BaseRepository implements CompanyRepositoryInterface
{
    protected function modelClass(): string
    {
        return Company::class;
    }
}
