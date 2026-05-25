<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Car;
use App\Repositories\Contracts\CarRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

final class CarRepository extends BaseRepository implements CarRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->paginateFiltered([], $perPage);
    }

    /**
     * @param  array<string, mixed>  $filters
     */
    public function paginateFiltered(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()
            ->with(['manufacturer', 'machineModel', 'categories', 'images'])
            ->when($filters['manufacturer_id'] ?? null, fn ($query, $manufacturerId) => $query->where('manufacturer_id', $manufacturerId))
            ->when($filters['category_id'] ?? null, fn ($query, $categoryId) => $query->whereHas('categories', fn ($categoryQuery) => $categoryQuery->whereKey($categoryId)))
            ->when($filters['stock'] ?? null, fn ($query, $stock) => $query->where('stock', 'like', "%{$stock}%"))
            ->when($filters['year_min'] ?? null, fn ($query, $year) => $query->where('year', '>=', $year))
            ->when($filters['year_max'] ?? null, fn ($query, $year) => $query->where('year', '<=', $year))
            ->when($filters['price_min'] ?? null, fn ($query, $price) => $query->where('price', '>=', $price))
            ->when($filters['price_max'] ?? null, fn ($query, $price) => $query->where('price', '<=', $price))
            ->latest('id')
            ->paginate($perPage);
    }

    public function find(int $id): Model
    {
        return $this->query()
            ->with(['manufacturer', 'machineModel', 'categories', 'images'])
            ->findOrFail($id);
    }

    public function findByIdOrSlug(string $value): Model
    {
        return $this->query()
            ->with(['manufacturer', 'machineModel', 'categories', 'images'])
            ->where('slug', $value)
            ->when(is_numeric($value), fn ($query) => $query->orWhereKey((int) $value))
            ->firstOrFail();
    }

    /**
     * @param  array<int, int>  $categoryIds
     */
    public function syncCategories(Car $car, array $categoryIds): Car
    {
        $car->categories()->sync($categoryIds);

        return $car->load(['manufacturer', 'machineModel', 'categories', 'images']);
    }

    protected function modelClass(): string
    {
        return Car::class;
    }
}
