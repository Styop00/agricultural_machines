<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;

final class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    protected function modelClass(): string
    {
        return Category::class;
    }
}
