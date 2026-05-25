<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MachineModelRequest;
use App\Http\Resources\MachineModelResource;
use App\Services\MachineModelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MachineModelController extends Controller
{
    public function __construct(
        private MachineModelService $service,
    ) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        return MachineModelResource::collection($this->service->paginate($this->perPage($request)));
    }

    public function store(MachineModelRequest $request): MachineModelResource
    {
        return new MachineModelResource($this->service->create($request->validated()));
    }

    public function show(int $machineModel): MachineModelResource
    {
        return new MachineModelResource($this->service->find($machineModel)->load('manufacturer'));
    }

    public function update(MachineModelRequest $request, int $machineModel): MachineModelResource
    {
        return new MachineModelResource($this->service->update($this->service->find($machineModel), $request->validated()));
    }

    public function destroy(int $machineModel): JsonResponse
    {
        $this->service->delete($this->service->find($machineModel));

        return response()->json(status: 204);
    }
}
