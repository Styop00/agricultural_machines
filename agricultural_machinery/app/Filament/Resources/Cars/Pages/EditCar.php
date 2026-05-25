<?php

namespace App\Filament\Resources\Cars\Pages;

use App\Filament\Resources\Cars\CarResource;
use App\Support\CarSlug;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCar extends EditRecord
{
    protected static string $resource = CarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $this->record->forceFill([
            'slug' => CarSlug::make($this->record),
        ])->saveQuietly();
    }
}
