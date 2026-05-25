<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class WorkingTimeResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'department' => $this->department,
            'day_of_week' => $this->day_of_week,
            'opens_at' => $this->opens_at,
            'closes_at' => $this->closes_at,
            'is_closed' => $this->is_closed,
            'company' => new CompanyResource($this->whenLoaded('company')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
