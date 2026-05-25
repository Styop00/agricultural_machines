<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkingTimeRequest;
use App\Http\Resources\WorkingTimeResource;
use App\Services\WorkingTimeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WorkingTimeController extends Controller
{
    public function __construct(
        private WorkingTimeService $service,
    ) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        return WorkingTimeResource::collection($this->service->paginate($this->perPage($request)));
    }

    public function store(WorkingTimeRequest $request): WorkingTimeResource
    {
        return new WorkingTimeResource($this->service->create($request->validated()));
    }

    public function show(int $workingTime): WorkingTimeResource
    {
        return new WorkingTimeResource($this->service->find($workingTime)->load('company'));
    }

    public function update(WorkingTimeRequest $request, int $workingTime): WorkingTimeResource
    {
        return new WorkingTimeResource($this->service->update($this->service->find($workingTime), $request->validated()));
    }

    public function destroy(int $workingTime): JsonResponse
    {
        $this->service->delete($this->service->find($workingTime));

        return response()->json(status: 204);
    }
}
