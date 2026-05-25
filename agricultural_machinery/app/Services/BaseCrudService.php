<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\CrudRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

abstract readonly class BaseCrudService
{
    public function __construct(
        protected CrudRepositoryInterface $repository,
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function find(int $id): Model
    {
        return $this->repository->find($id);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(Model $model, array $data): Model
    {
        return $this->repository->update($model, $data);
    }

    public function delete(Model $model): bool
    {
        return $this->repository->delete($model);
    }
}
