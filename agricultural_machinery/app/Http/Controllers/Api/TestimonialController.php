<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestimonialResource;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class TestimonialController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $testimonials = Testimonial::query()
            ->when($request->boolean('featured'), fn ($query) => $query->where('is_featured', true))
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request));

        return TestimonialResource::collection($testimonials);
    }

    public function show(Testimonial $testimonial): TestimonialResource
    {
        return new TestimonialResource($testimonial);
    }
}
