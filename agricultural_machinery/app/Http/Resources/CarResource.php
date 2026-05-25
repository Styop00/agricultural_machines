<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class CarResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'manufacturer_id' => $this->manufacturer_id,
            'machine_model_id' => $this->machine_model_id,
            'year' => $this->year,
            'stock' => $this->stock,
            'slug' => $this->slug,
            'odometer' => $this->odometer,
            'engine' => $this->engine,
            'price' => $this->price,
            'description' => $this->description,
            'manufacturer' => new ManufacturerResource($this->whenLoaded('manufacturer')),
            'model' => new MachineModelResource($this->whenLoaded('machineModel')),
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'images' => CarImageResource::collection($this->whenLoaded('images')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
