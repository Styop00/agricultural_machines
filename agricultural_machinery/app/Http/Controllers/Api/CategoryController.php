<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryService $service,
    ) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        return CategoryResource::collection($this->service->paginate($this->perPage($request)));
    }

    public function store(CategoryRequest $request): CategoryResource
    {
        return new CategoryResource($this->service->create($request->validated()));
    }

    public function show(int $category): CategoryResource
    {
        return new CategoryResource($this->service->find($category));
    }

    public function update(CategoryRequest $request, int $category): CategoryResource
    {
        return new CategoryResource($this->service->update($this->service->find($category), $request->validated()));
    }

    public function destroy(int $category): JsonResponse
    {
        $this->service->delete($this->service->find($category));

        return response()->json(status: 204);
    }
}
