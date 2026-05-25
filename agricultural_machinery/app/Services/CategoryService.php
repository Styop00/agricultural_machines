<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;

final readonly class CategoryService extends BaseCrudService
{
    public function __construct(CategoryRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }
}
