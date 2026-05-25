<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompanyController extends Controller
{
    public function __construct(
        private CompanyService $service,
    ) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        return CompanyResource::collection($this->service->paginate($this->perPage($request)));
    }

    public function store(CompanyRequest $request): CompanyResource
    {
        return new CompanyResource($this->service->create($request->validated()));
    }

    public function show(int $company): CompanyResource
    {
        return new CompanyResource($this->service->find($company)->load('workingTimes'));
    }

    public function update(CompanyRequest $request, int $company): CompanyResource
    {
        return new CompanyResource($this->service->update($this->service->find($company), $request->validated()));
    }

    public function destroy(int $company): JsonResponse
    {
        $this->service->delete($this->service->find($company));

        return response()->json(status: 204);
    }
}
