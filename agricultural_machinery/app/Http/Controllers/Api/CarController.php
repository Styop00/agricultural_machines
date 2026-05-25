<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Http\Resources\CarResource;
use App\Services\CarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CarController extends Controller
{
    public function __construct(
        private CarService $service,
    ) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        $filters = $request->validate([
            'manufacturer_id' => ['nullable', 'integer', 'exists:manufacturers,id'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'stock' => ['nullable', 'string', 'max:100'],
            'year_min' => ['nullable', 'integer', 'between:1900,'.((int) date('Y') + 1)],
            'year_max' => ['nullable', 'integer', 'between:1900,'.((int) date('Y') + 1)],
            'price_min' => ['nullable', 'numeric', 'min:0'],
            'price_max' => ['nullable', 'numeric', 'min:0'],
        ]);

        return CarResource::collection($this->service->paginateFiltered($filters, $this->perPage($request)));
    }

    public function store(CarRequest $request): CarResource
    {
        return new CarResource($this->service->create($request->validated()));
    }

    public function show(string $car): CarResource
    {
        return new CarResource($this->service->findByIdOrSlug($car));
    }

    public function update(CarRequest $request, int $car): CarResource
    {
        return new CarResource($this->service->update($this->service->find($car), $request->validated()));
    }

    public function destroy(int $car): JsonResponse
    {
        $this->service->delete($this->service->find($car));

        return response()->json(status: 204);
    }
}
