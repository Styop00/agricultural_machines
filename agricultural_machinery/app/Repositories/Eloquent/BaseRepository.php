<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CrudRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 */
abstract class BaseRepository implements CrudRepositoryInterface
{
    /**
     * @return class-string<TModel>
     */
    abstract protected function modelClass(): string;

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()->latest('id')->paginate($perPage);
    }

    public function find(int $id): Model
    {
        return $this->query()->findOrFail($id);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Model
    {
        return $this->query()->create($data);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(Model $model, array $data): Model
    {
        $model->update($data);

        return $model->refresh();
    }

    public function delete(Model $model): bool
    {
        return (bool) $model->delete();
    }

    /**
     * @return Builder<TModel>
     */
    protected function query(): Builder
    {
        return $this->modelClass()::query();
    }
}
