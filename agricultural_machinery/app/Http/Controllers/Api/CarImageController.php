<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarImageRequest;
use App\Http\Resources\CarImageResource;
use App\Services\CarImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CarImageController extends Controller
{
    public function __construct(
        private CarImageService $service,
    ) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        return CarImageResource::collection($this->service->paginate($this->perPage($request)));
    }

    public function store(CarImageRequest $request): CarImageResource
    {
        return new CarImageResource($this->service->create($request->validated()));
    }

    public function show(int $carImage): CarImageResource
    {
        return new CarImageResource($this->service->find($carImage));
    }

    public function update(CarImageRequest $request, int $carImage): CarImageResource
    {
        return new CarImageResource($this->service->update($this->service->find($carImage), $request->validated()));
    }

    public function destroy(int $carImage): JsonResponse
    {
        $this->service->delete($this->service->find($carImage));

        return response()->json(status: 204);
    }
}
