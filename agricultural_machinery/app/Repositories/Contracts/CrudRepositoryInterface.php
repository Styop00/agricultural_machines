<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

interface CrudRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;

    public function find(int $id): Model;

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Model;

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(Model $model, array $data): Model;

    public function delete(Model $model): bool;
}
