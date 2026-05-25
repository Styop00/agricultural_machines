<?php

namespace App\Filament\Resources\Cars\Pages;

use App\Filament\Resources\Cars\CarResource;
use App\Support\CarSlug;
use Filament\Resources\Pages\CreateRecord;

class CreateCar extends CreateRecord
{
    protected static string $resource = CarResource::class;

    protected function afterCreate(): void
    {
        $this->record->forceFill([
            'slug' => CarSlug::make($this->record),
        ])->saveQuietly();
    }
}
