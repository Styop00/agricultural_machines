<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\CarImage;
use App\Repositories\Contracts\CarImageRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final readonly class CarImageService extends BaseCrudService
{
    public function __construct(
        private CarImageRepositoryInterface $carImageRepository,
    ) {
        parent::__construct($carImageRepository);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Model
    {
        return DB::transaction(function () use ($data): CarImage {
            if (($data['is_primary'] ?? false) === true) {
                $this->carImageRepository->clearPrimaryForCar((int) $data['car_id']);
            }

            /** @var CarImage $image */
            $image = $this->carImageRepository->create($data);

            return $image;
        });
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(Model $model, array $data): Model
    {
        if (! $model instanceof CarImage) {
            throw new \InvalidArgumentException('Car image service can only update car image models.');
        }

        return DB::transaction(function () use ($model, $data): CarImage {
            $carId = (int) ($data['car_id'] ?? $model->car_id);

            if (($data['is_primary'] ?? false) === true) {
                $this->carImageRepository->clearPrimaryForCar($carId, $model->id);
            }

            /** @var CarImage $image */
            $image = $this->carImageRepository->update($model, $data);

            return $image;
        });
    }
}
