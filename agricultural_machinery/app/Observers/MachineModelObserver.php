<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\MachineModel;
use Illuminate\Support\Str;

final class MachineModelObserver
{
    public function saving(MachineModel $machineModel): void
    {
        if (! $machineModel->exists || $machineModel->isDirty('name') || $machineModel->isDirty('manufacturer_id')) {
            $machineModel->slug = $this->uniqueSlug($machineModel);
        }
    }

    private function uniqueSlug(MachineModel $machineModel): string
    {
        $baseSlug = Str::slug($machineModel->name);
        $slug = $baseSlug;
        $counter = 2;

        while (
            MachineModel::query()
                ->where('manufacturer_id', $machineModel->manufacturer_id)
                ->where('slug', $slug)
                ->when($machineModel->exists, fn ($query) => $query->whereKeyNot($machineModel->id))
                ->exists()
        ) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
