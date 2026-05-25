<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Car;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

interface CarRepositoryInterface extends CrudRepositoryInterface
{
    /**
     * @param  array<string, mixed>  $filters
     */
    public function paginateFiltered(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    public function findByIdOrSlug(string $value): Model;

    /**
     * @param  array<int, int>  $categoryIds
     */
    public function syncCategories(Car $car, array $categoryIds): Car;
}
