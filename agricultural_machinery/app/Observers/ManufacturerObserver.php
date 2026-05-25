<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Manufacturer;
use Illuminate\Support\Str;

final class ManufacturerObserver
{
    public function saving(Manufacturer $manufacturer): void
    {
        if (! $manufacturer->exists || $manufacturer->isDirty('name')) {
            $manufacturer->slug = $this->uniqueSlug($manufacturer);
        }
    }

    private function uniqueSlug(Manufacturer $manufacturer): string
    {
        $baseSlug = Str::slug($manufacturer->name);
        $slug = $baseSlug;
        $counter = 2;

        while (
            Manufacturer::query()
                ->where('slug', $slug)
                ->when($manufacturer->exists, fn ($query) => $query->whereKeyNot($manufacturer->id))
                ->exists()
        ) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
