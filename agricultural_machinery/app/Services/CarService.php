<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Car;
use App\Models\MachineModel;
use App\Repositories\Contracts\CarRepositoryInterface;
use App\Repositories\Contracts\MachineModelRepositoryInterface;
use App\Support\CarSlug;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

final readonly class CarService extends BaseCrudService
{
    public function __construct(
        private CarRepositoryInterface $carRepository,
        private MachineModelRepositoryInterface $machineModelRepository,
    ) {
        parent::__construct($carRepository);
    }

    /**
     * @param  array<string, mixed>  $filters
     */
    public function paginateFiltered(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->carRepository->paginateFiltered($filters, $perPage);
    }

    public function findByIdOrSlug(string $value): Model
    {
        return $this->carRepository->findByIdOrSlug($value);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Model
    {
        return DB::transaction(function () use ($data): Car {
            $categoryIds = $data['category_ids'] ?? [];
            unset($data['category_ids']);

            $this->ensureModelBelongsToManufacturer(
                (int) $data['machine_model_id'],
                (int) $data['manufacturer_id'],
            );

            /** @var Car $car */
            $car = $this->carRepository->create($data);
            $car = $this->carRepository->syncCategories($car, $categoryIds);

            return $this->refreshSlug($car);
        });
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(Model $model, array $data): Model
    {
        if (! $model instanceof Car) {
            throw new \InvalidArgumentException('Car service can only update car models.');
        }

        return DB::transaction(function () use ($model, $data): Car {
            $categoryIds = $data['category_ids'] ?? null;
            unset($data['category_ids']);

            $machineModelId = (int) ($data['machine_model_id'] ?? $model->machine_model_id);
            $manufacturerId = (int) ($data['manufacturer_id'] ?? $model->manufacturer_id);

            $this->ensureModelBelongsToManufacturer($machineModelId, $manufacturerId);

            /** @var Car $car */
            $car = $this->carRepository->update($model, $data);

            if (is_array($categoryIds)) {
                $car = $this->carRepository->syncCategories($car, $categoryIds);
            } else {
                $car->load(['manufacturer', 'machineModel', 'categories', 'images']);
            }

            return $this->refreshSlug($car);
        });
    }

    private function refreshSlug(Car $car): Car
    {
        $car->forceFill([
            'slug' => CarSlug::make($car),
        ])->saveQuietly();

        return $car->refresh();
    }

    private function ensureModelBelongsToManufacturer(int $machineModelId, int $manufacturerId): void
    {
        $machineModel = $this->machineModelRepository->find($machineModelId);

        if (! $machineModel instanceof MachineModel || $machineModel->manufacturer_id !== $manufacturerId) {
            throw ValidationException::withMessages([
                'machine_model_id' => ['The selected machine model does not belong to the selected manufacturer.'],
            ]);
        }
    }
}
