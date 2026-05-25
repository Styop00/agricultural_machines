<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManufacturerRequest;
use App\Http\Resources\ManufacturerResource;
use App\Services\ManufacturerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ManufacturerController extends Controller
{
    public function __construct(
        private ManufacturerService $service,
    ) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        return ManufacturerResource::collection($this->service->paginate($this->perPage($request)));
    }

    public function store(ManufacturerRequest $request): ManufacturerResource
    {
        return new ManufacturerResource($this->service->create($request->validated()));
    }

    public function show(int $manufacturer): ManufacturerResource
    {
        return new ManufacturerResource($this->service->find($manufacturer)->load('machineModels'));
    }

    public function update(ManufacturerRequest $request, int $manufacturer): ManufacturerResource
    {
        return new ManufacturerResource($this->service->update($this->service->find($manufacturer), $request->validated()));
    }

    public function destroy(int $manufacturer): JsonResponse
    {
        $this->service->delete($this->service->find($manufacturer));

        return response()->json(status: 204);
    }
}
